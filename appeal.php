<?php
require 'includes/discord.php';
require 'includes/config.php';

init("https://www.techsupportcentral.cf/appeal.php", $client_id, $secret_id);
get_user(true);
?>

<html>
	<head>
		<title> Ban Appeal | Tech Support Central </title>
		<style>
			#MainBody {
			height: 240px;
			border-radius: 5px;
			background-color: #f2f2f2;
			padding: 20px 20px;
			}
		</style>
		<?php include 'includes/head.php';?>
	</head>
	<body bgcolor="#323232">
		<div id="Container">
			<?php
			include 'includes/header.php';
			echo '<div id="MainBody">';
			if (isset($_SESSION['username'])) {
				if (substr($_SESSION['user_avatar'], 0, 2) == "a_") {
					$extension = ".gif";
				} else {
					$extension = ".png";
				}
				echo '
				<br>
				<form action="submit-form.php" method=”post”>
					<label for="q1"> Why were you banned? </label><br>
					<input type="text" name="q1"><br>

					<label for="q2"> Why do you disagree with the reasoning for your ban? </label><br>
					<input type="text" name="q2"><br>

					<input type="hidden" name="username" value=' . $_SESSION['username'] . '>
					<input type="hidden" name="id" value=' . $_SESSION['user_id'] . '>
					<input type="hidden" name="email" value=' . $_SESSION['email'] . '>
					<input type="hidden" name="avatar" value=' . $_SESSION['user_avatar'] . '>
					<input type="hidden" name="extension" value=' . $extension . '>
					<input type="hidden" name="type" value="appeal">
					<input type="submit" value="Submit">
				</form>
				';
			} elseif ($_GET['form'] == "done") {
				echo '
				<div class="center">
					<h1> Appeal sent successfully. You will be notified of whether your appeal was accepted via the email you signed up for Discord with. </h1>
				</div>
				';
			} elseif ($_GET['form'] == "fail") {
				echo '
				<div class="center">
					<h1> Something went wrong sending the appeal. Please try again. </h1>
				</div>
				';
			} else {
				echo '
				<div class="center">
					<h1> Please log in before submitting your appeal. </h1>
					<a href=' . url($client_id, "https://www.techsupportcentral.cf/appeal.php", "email") . '> <img src="login.png", width=512, height=107> </a>
				</div>
				';
			}
			echo '</div>';
			include 'includes/footer.php';
			?>
		</div>
	</body>
</html>
