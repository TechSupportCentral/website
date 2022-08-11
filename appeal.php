<?php require 'includes/applications.php';?>

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
		<?php include 'includes/head.html';?>
	</head>
	<body bgcolor="#323232">
		<div id="Container">
			<?php
			include 'includes/header.html';
			if (isset($_SESSION['username'])) {$submit = submission_check($_SESSION['user_id'], "appeal", $mongo_db, $mongo_uri);}
			echo '<div id="MainBody">';
			if (isset($_SESSION['username']) && !$submit) {
				if (substr($_SESSION['user_avatar'], 0, 2) == "a_") {
					$extension = ".gif";
				} else {
					$extension = ".png";
				}
				echo '
				<br>
				<form action="submit-form.php" method="post">
					<label for="q1" style="font-weight: bold"> Why were you banned? </label><br>
					<input type="text" name="q1"><br>

					<label for="q2" style="font-weight: bold"> Why do you disagree with the reasoning for your ban? </label><br>
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
			} elseif (isset($_SESSION['username']) && $submit) {
				echo '<h2 style="text-align: center"> You have already submitted a ban appeal. <br> If it gets accepted, you will be notified. Please be patient. </h2>';
			} elseif ($_GET['form'] == "done") {
				echo '<h1 style="text-align: center; margin-left: 32px; margin-right: 32px"> Appeal sent successfully. <br><br> You will be notified about whether your appeal was accepted via the email you signed up for Discord with. </h1>';
			} elseif ($_GET['form'] == "fail") {
				echo '<h1 style="text-align: center"> Something went wrong sending the appeal. Please try again. </h1>';
			} else {
				echo '
				<div class="center">
					<h1> Please log in before submitting your appeal. </h1>
					<a href=' . url($client_id, "https://www.techsupportcentral.cf/appeal.php", "email") . '> <img src="login.png", width=512, height=107> </a>
				</div>
				';
			}
			echo '</div>';
			include 'includes/footer.html';
			?>
		</div>
	</body>
</html>
