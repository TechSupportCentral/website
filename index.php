<!DOCTYPE html>
<html lang="en">
    <?php
        $title = "Home | Tech Support Central";
        $stylesheet = 'index.css';
        include 'includes/head.php';
    ?>
    <body>
        <?php include 'includes/header.html'; ?>
        <div id="content">
            <div class="main-content">
                <h1 id="title">Welcome to Tech Support Central!</h1>
                <h2>What we offer:</h2>
                <ul>
                    <li>Free and fast tech support for a wide range of problems</li>
                    <li>Tech discussions where you can show off your setups</li>
                    <li>Shopping recommendations, from tablets to PCs to game consoles</li>
                </ul>
                <p>We're always looking for more support team members, so apply if you wish and help out others!</p>
            </div>
            <div class="sidebar">
                <iframe src="https://discord.com/widget?id=824042976371277884&amp;theme=dark" width="90%" height="90%" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
            </div>
        </div>
        <?php include 'includes/footer.html'; ?>
    </body>
</html>