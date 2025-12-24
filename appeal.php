<!DOCTYPE html>
<html lang="en">
    <?php
        $title = "Ban Appeal | Tech Support Central";
        $stylesheet = 'appeal.css';
        include 'includes/head.php';
    ?>
    <body>
        <?php include 'includes/header.html'; ?>
        <div id="content">
            <form action="scripts/submit.php" method="post">
                <label for="reason">Why were you banned?</label>
                <input id="reason" name="reason" type="text" required>
                <label for="appeal">Why do you disagree with the reasoning for your ban?</label>
                <textarea id="appeal" name="appeal" rows="3" required></textarea>
                <?php
                    // TODO: Discord login
                    $_SESSION['username'] = "test user";
                    $_SESSION['user_id'] = 760604690010079282;
                    $_SESSION['email'] = 'test@techsupportcentral.org';
                    $_SESSION['user_avatar'] = '';
                    if (str_starts_with($_SESSION['user_avatar'], "a_")) {
                        $extension = ".gif";
                    } else {
                        $extension = ".png";
                    }
                    echo '<br>
                    <input type="hidden" name="username" value="' . $_SESSION['username'] . '">
                    <input type="hidden" name="id" value="' . $_SESSION['user_id'] . '">
                    <input type="hidden" name="email" value="' . $_SESSION['email'] . '">
                    <input type="hidden" name="avatar" value="' . $_SESSION['user_avatar'] . '">
                    <input type="hidden" name="extension" value="' . $extension . '">
                    <input type="hidden" name="type" value="appeal">';
                ?>
                <input type="submit" value="Submit Appeal">
            </form>
        </div>
        <?php include 'includes/footer.html'; ?>
    </body>
</html>