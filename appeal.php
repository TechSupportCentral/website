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
            <form>
                <label for="reason">Why were you banned?</label>
                <input id="reason" type="text" required>
                <label for="appeal">Why do you disagree with the reasoning for your ban?</label>
                <textarea id="appeal" rows="3" required></textarea>
                <input type="submit" value="Submit Appeal">
            </form>
        </div>
        <?php include 'includes/footer.html'; ?>
    </body>
</html>