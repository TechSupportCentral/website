<!DOCTYPE html>
<html lang="en">
    <?php
        $title = "Discord Login | Tech Support Central";
        $stylesheet = 'login.css';
        include 'includes/head.php';
    ?>
    <body>
        <?php include 'includes/header.html'; ?>
        <div id="content">
            <h1>Please log in before submitting your application.</h1>
            <?php
                require 'scripts/auth.php';
                $scope = match($_GET['redir']) {
                    'appeal.php' => 'email',
                    default => 'identify+guilds.members.read'
                };
                echo '<div id="login-image"><a href=' . url($client_id, $site_root . $_GET['redir'], $scope) . '><img src="login.png" alt="Log in with Discord"></a></div>';
            ?>
        </div>
        <?php include 'includes/footer.html'; ?>
    </body>
</html>