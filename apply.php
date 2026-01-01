<?php
    require 'scripts/auth.php';
    if (!isset($_SESSION['username'])) {
        header("Location: login.php?redir=apply.php");
        exit;
    }
    switch (age_check(15778800, 2629800)) {
        case 0:
            break;
        case 1:
            $status = 'ageCheckFail';
            break;
        case 2:
            $status = 'joinCheckFail';
    }
    if (submission_check()) {
        $status = 'submissionCheckFail';
    }
    if (isset($status)) {
        echo "<script>
            window.onload = function() {
                // Make a fake form to do a POST redirect
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = 'result.php';
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'status';
                input.value = '$status';
                form.appendChild(input);
                // Add form to document and immediately submit
                document.body.appendChild(form);
                form.submit();
            }
        </script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php
        $title = "Staff Application | Tech Support Central";
        $stylesheet = 'application.css';
        include 'includes/head.php';
    ?>
    <body>
        <?php include 'includes/header.html'; ?>
        <div id="content">
            <form action="scripts/submit.php" method="post">
                <p>What role are you applying for?</p>
                <input type="radio" id="mod" name="type" value="mod">
                <label for="mod">Moderator</label><br>
                <input type="radio" id="sp" name="type" value="sp">
                <label for="sp">Support Team</label>
                <?php
                    require('includes/config.php');
                    foreach ($application_questions as $questionName => $question) {
                        echo '<div class="hide';
                        if (str_starts_with($questionName, "mod")) {
                            echo ' modQuestion';
                        } elseif (str_starts_with($questionName, "sp")) {
                            echo ' spteamQuestion';
                        }
                        echo '"><p>' . $question['q'] . '</p>';
                        if ($question['type'] == 'boolean') {
                            echo '<input type="checkbox" name="' . $questionName . '" id="' . $questionName . '">';
                            echo '<label for="' . $questionName . '">I understand.</label><br>';
                        }
                        foreach ($question as $optionName => $optionText) {
                            if ($optionName == 'q' || $optionName == 'type') continue;
                            if ($question['type'] == "checkbox") {
                                echo '<input type="' . $question['type'] . '" name="' . $questionName.$optionName . '">';
                            } else {
                                echo '<input type="' . $question['type'] . '" id="' . $questionName.$optionName . '" name="' . $questionName . '" value="' . $optionName[-1] . '">';
                            }
                            echo '<label for="' . $questionName.$optionName . '">' . $optionText . '</label><br>';
                        }
                        echo '</div>';
                    }
                    if (str_starts_with($_SESSION['user_avatar'], "a_")) {
                        $extension = ".gif";
                    } else {
                        $extension = ".png";
                    }
                    echo '<br>
                    <input type="hidden" name="username" value="' . $_SESSION['username'] . '">
                    <input type="hidden" name="id" value="' . $_SESSION['user_id'] . '">
                    <input type="hidden" name="avatar" value="' . $_SESSION['user_avatar'] . '">
                    <input type="hidden" name="extension" value="' . $extension . '">';
                ?>
                <input type="submit" class="hide" value="Submit Application">
                <script>
                    function addRequired(element) {
                        element.querySelectorAll(':scope > *').forEach(child => {
                            // Support Team question 3 can have multiple answers, not required
                            if (child.tagName === "INPUT" && !child.getAttribute("name").startsWith("sp3")) {
                                child.required = true;
                            }
                        });
                    }
                    function removeRequired(element) {
                        element.querySelectorAll(':scope > *').forEach(child => {
                            if (child.tagName === "INPUT") {
                                child.required = false;
                            }
                        });
                    }
                    function hideModQuestions() {
                        document.querySelectorAll('.modQuestion').forEach(element => {
                            element.classList.add('hide');
                            removeRequired(element);
                        });
                        document.querySelectorAll('.spteamQuestion').forEach(element => {
                            element.classList.remove('hide');
                            addRequired(element);
                        });
                        document.querySelector('input[type=submit]').classList.remove('hide');
                    }
                    function hideSupportTeamQuestions() {
                        document.querySelectorAll('.modQuestion').forEach(element => {
                            element.classList.remove('hide');
                            addRequired(element);
                        });
                        document.querySelectorAll('.spteamQuestion').forEach(element => {
                            element.classList.add('hide');
                            removeRequired(element);
                        });
                        document.querySelector('input[type=submit]').classList.remove('hide');
                    }
                    document.getElementById('mod').onclick = hideSupportTeamQuestions;
                    document.getElementById('sp').onclick = hideModQuestions;
                </script>
            </form>
        </div>
        <?php include 'includes/footer.html'; ?>
    </body>
</html>