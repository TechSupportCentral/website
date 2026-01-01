<!DOCTYPE html>
<html lang="en">
    <?php
        $title = "Submission | Tech Support Central";
        $stylesheet = 'result.css';
        include 'includes/head.php';
    ?>
    <body>
        <?php include 'includes/header.html'; ?>
        <div id="content">
            <h2><?php
                echo match ($_POST['status']) {
                    'applySuccess' => 'Application sent successfully.<br><br>You will be notified via DM if the application is accepted.',
                    'appealSuccess' => 'Appeal sent successfully.<br><br>You will be notified of your appeal status via the email associated with your Discord account.',
                    'embedFail' => 'Something went wrong on Discord\'s end, please try again.',
                    'dbOpenFail' => 'Database open error, please try again.',
                    'dbExecFail' => 'Database error, please try again.',
                    'ageCheckFail' => 'Your Discord account is not old enough (6 months) for this position.<br>Please read the requirements next time.',
                    'joinCheckFail' => 'You have not been in TSC for long enough (1 month) for this position.<br>Please read the requirements next time.',
                    'submissionCheckFail' => 'Your previous submission is still in review.<br>If it gets accepted, you will be notified. Please be patient.',
                    default => 'Unknown error, please try again.',
                };
            ?></h2>
        </div>
        <?php include 'includes/footer.html'; ?>
    </body>
</html>