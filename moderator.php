<?php
require 'includes/discord.php';
require 'includes/config.php';

init("https://www.techsupportcentral.cf/moderator.php", $client_id, $secret_id);
get_user();
?>

<html>
	<head>
		<title> Moderator Application | Tech Support Central </title>
		<style>
			#MainBody {
			height: 750px;
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
					<label for="q1"> If a member is doing something against our rules (i.e. spamming, sending NSFW), what do you do? </label><br>
					<input type="radio" id="q1o1" name="q1" value="Leave it and see what happens">
					<label for="q1o1"> Leave it and see what happens </label><br>
					<input type="radio" id="q1o2" name="q1" value="Mute the member">
					<label for="q1o2"> Mute the member </label><br>
					<input type="radio" id="q1o3" name="q1" value="Ban the member">
					<label for="q1o3"> Ban the member </label><br>
					<input type="radio" id="q1o4" name="q1" value="Issue a warning">
					<label for="q1o4"> Issue a warning </label><br>
					<br>
					<label for="q2"> If you or another member receives self promotion, what do you do? </label><br>
					<input type="radio" id="q2o1" name="q2" value="Do nothing">
					<label for="q2o1"> Do nothing </label><br>
					<input type="radio" id="q2o2" name="q2" value="Mute the member">
					<label for="q2o2"> Mute the member </label><br>
					<input type="radio" id="q2o3" name="q2" value="Ban the member">
					<label for="q2o3"> Ban the member </label><br>
					<input type="radio" id="q2o4" name="q2" value="Issue a warning">
					<label for="q2o4"> Issue a warning </label><br>
					<br>
					<label for="q3"> If a member asks for help or advice with cracked/illegal content, what do you do? </label><br>
					<input type="radio" id="q3o1" name="q3" value="Do nothing">
					<label for="q3o1"> Do nothing </label><br>
					<input type="radio" id="q3o2" name="q3" value="Ban the member">
					<label for="q3o2"> Ban the member </label><br>
					<input type="radio" id="q3o3" name="q3" value="Warn the member; in the warn message, let them know about our rules">
					<label for="q3o3"> Warn the member; in the warn message, let them know about our rules </label><br>
					<input type="radio" id="q3o4" name="q3" value="Inform the member publicly of our rules and that we cannot offer any help.">
					<label for="q3o4"> Inform the member publicly of our rules and that we cannot offer any help. </label><br>
					<br>
					<label for="q4"> We ask you to enable Developer Mode in Discord settings so you can retrieve a user ID to make it easier to sanction a member. </label><br>
					<input type="radio" id="q4o1" name="q4" value="I understand; I will enable developer mode.">
					<label for="q4o1"> I understand; I will enable developer mode. </label><br>
					<input type="radio" id="q4o2" name="q4" value="I understand; I am unsure how to do this and a staff member will show you how to enable this.">
					<label for="q4o2"> I understand; I am unsure how to do this, so a staff member will show me how to enable this if/when I become a moderator. </label><br>
					<br>
					<label for="q5"> If your Mod application gets accepted, you will temporarily receive a "Trial Moderator" role which is a trial period to see if this role is for you. </label><br>
					<input type="radio" id="q5o1" name="q5" value="I understand.">
					<label for="q5o1"> I understand. </label><br>
					<br>
					<label for="q6"> Applying for this role means that you have the opportunity to become a Moderator; if you wish to be a Support Team member as well then you can apply via the Support Team application form. </label><br>
					<input type="radio" id="q6o1" name="q6" value="I understand.">
					<label for="q6o1"> I understand. </label><br>
					<br>
					<label for="q7"> As a moderator, you will have to adhere and follow the rules. </label><br>
					<input type="radio" id="q7o1" name="q7" value="I understand.">
					<label for="q7o1"> I understand. </label><br>
					<br>
					<input type="hidden" name="username" value=' . $_SESSION['username'] . '>
					<input type="hidden" name="id" value=' . $_SESSION['user_id'] . '>
					<input type="hidden" name="avatar" value=' . $_SESSION['user_avatar'] . '>
					<input type="hidden" name="extension" value=' . $extension . '>
					<input type="hidden" name="type" value="moderator">
					<input type="submit" value="Submit">
				</form>
				';
			} elseif ($_GET['form'] == "done") {
				echo '
				<div class="center">
					<h1> Form sent successfully. </h1>
				</div>
				';
			} elseif ($_GET['form'] == "fail") {
				echo '
				<div class="center">
					<h1> Something went wrong sending the form. Please try again. </h1>
				</div>
				';
			} else {
				echo '
				<div class="center">
					<h1> Please log in before submitting your application. </h1>
					<a href=' . url($client_id, "https://www.techsupportcentral.cf/moderator.php", "identify") . '> <img src="login.png", width=512, height=107> </a>
				</div>
				';
			}
			echo '</div>';
			include 'includes/footer.php';
			?>
		</div>
	</body>
</html>
