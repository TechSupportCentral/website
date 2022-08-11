<?php require 'includes/applications.php';?>

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
		<?php include 'includes/head.html';?>
	</head>
	<body bgcolor="#323232">
		<div id="Container">
			<?php
			include 'includes/header.html';

			if (isset($_SESSION['username'])) {
				$age = age_check(15778800, 2629800);
				$submit = submission_check($_SESSION['user_id'], "moderator", $mongo_db, $mongo_uri);
			}

			echo '<div id="MainBody">';
			if (isset($_SESSION['username']) && $age == 0 && !$submit) {
				if (substr($_SESSION['user_avatar'], 0, 2) == "a_") {
					$extension = ".gif";
				} else {
					$extension = ".png";
				}
				echo '
				<br>
				<form action="submit-form.php" method="post">
					<label for="q1" style="font-weight: bold"> If a member is doing something against our rules (i.e. spamming, sending NSFW), what do you do? </label><br>
					<input type="radio" id="q1o1" name="q1" value="Leave it and see what happens">
					<label for="q1o1"> Leave it and see what happens </label><br>
					<input type="radio" id="q1o2" name="q1" value="Mute the member">
					<label for="q1o2"> Mute the member </label><br>
					<input type="radio" id="q1o3" name="q1" value="Ban the member">
					<label for="q1o3"> Ban the member </label><br>
					<input type="radio" id="q1o4" name="q1" value="Issue a warning">
					<label for="q1o4"> Issue a warning </label><br>
					<br>
					<label for="q2" style="font-weight: bold"> If you or another member receives self promotion, what do you do? </label><br>
					<input type="radio" id="q2o1" name="q2" value="Do nothing">
					<label for="q2o1"> Do nothing </label><br>
					<input type="radio" id="q2o2" name="q2" value="Mute the member">
					<label for="q2o2"> Mute the member </label><br>
					<input type="radio" id="q2o3" name="q2" value="Ban the member">
					<label for="q2o3"> Ban the member </label><br>
					<input type="radio" id="q2o4" name="q2" value="Issue a warning">
					<label for="q2o4"> Issue a warning </label><br>
					<br>
					<label for="q3" style="font-weight: bold"> If a member asks for help or advice with cracked/illegal content, what do you do? </label><br>
					<input type="radio" id="q3o1" name="q3" value="Do nothing">
					<label for="q3o1"> Do nothing </label><br>
					<input type="radio" id="q3o2" name="q3" value="Ban the member">
					<label for="q3o2"> Ban the member </label><br>
					<input type="radio" id="q3o3" name="q3" value="Warn the member; in the warn message, let them know about our rules">
					<label for="q3o3"> Warn the member; in the warn message, let them know about our rules </label><br>
					<input type="radio" id="q3o4" name="q3" value="Inform the member publicly of our rules and that we cannot offer any help.">
					<label for="q3o4"> Inform the member publicly of our rules and that we cannot offer any help. </label><br>
					<br>
					<label for="q4" style="font-weight: bold"> We ask you to enable Developer Mode in Discord settings so you can retrieve a user ID to make it easier to sanction a member. </label><br>
					<input type="radio" id="q4o1" name="q4" value="I understand; I will enable developer mode.">
					<label for="q4o1"> I understand; I will enable developer mode. </label><br>
					<input type="radio" id="q4o2" name="q4" value="I understand; I am unsure how to do this and a staff member will show you how to enable this.">
					<label for="q4o2"> I understand; I am unsure how to do this, so a staff member will show me how to enable this if/when I become a moderator. </label><br>
					<br>
					<label for="q5" style="font-weight: bold"> If your Mod application gets accepted, you will temporarily receive a "Trial Moderator" role which is a trial period to see if this role is for you. </label><br>
					<input type="checkbox" id="q5o1" name="q5" value="I understand.">
					<label for="q5o1"> I understand. </label><br>
					<br>
					<label for="q6" style="font-weight: bold"> Applying for this role means that you have the opportunity to become a Moderator; if you wish to be a Support Team member as well then you can apply via the Support Team application form. </label><br>
					<input type="checkbox" id="q6o1" name="q6" value="I understand.">
					<label for="q6o1"> I understand. </label><br>
					<br>
					<label for="q7" style="font-weight: bold"> As a moderator, you will have to adhere and follow the rules. </label><br>
					<input type="checkbox" id="q7o1" name="q7" value="I understand.">
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
			} elseif (isset($_SESSION['username']) && $age == 1) {
				echo '<h2 style="text-align: center"> Your Discord account is not old enough (6 months) to become a moderator. <br> Please read the requirements next time. </h2>';
			} elseif (isset($_SESSION['username']) && $age == 2) {
				echo '<h2 style="text-align: center"> You have not been in TSC for long enough (1 month) to become a moderator. <br> Please read the requirements next time. </h2>';
			} elseif (isset($_SESSION['username']) && $submit) {
				echo '<h2 style="text-align: center"> You have already submitted a moderator application. <br> If it gets accepted, you will be notified. Please be patient. </h2>';
			} elseif ($_GET['form'] == "done") {
				echo '<h1 style="text-align: center"> Form sent successfully. </h1>';
			} elseif ($_GET['form'] == "fail") {
				echo '<h1 style="text-align: center"> Something went wrong sending the form. Please try again. </h1>';
			} elseif ($_POST['requirements'] == "done") {
				echo '
				<div class="center">
					<h1> Please log in before submitting your application. </h1>
					<a href=' . url($client_id, "https://www.techsupportcentral.cf/moderator.php", "identify") . '> <img src="login.png", width=512, height=107> </a>
				</div>
				';
			} else {
				echo '
				<form action="moderator.php" method="post">
					<h2 style="text-align: center"> Before you can apply to be a moderator, you must read the requirements. </h2>
					<br>
					<h3> Moderator Requirements: </h3>
					<ul>
						<li> <b> Corruption: </b> If a member of the staff team does something they shouldn\'t have, let the owners know. </li>
						<br>
						<li> <b> Rules: </b> You need to read the rules and know when to warn, mute, kick, and ban. </li>
						<br>
						<li> <b> Activity: </b> Moderators need to be active 6-7 times a week. </li>
						<br>
						<li> <b> Experience: </b> You need to have been on the server for at least a month and have a discord account older than 6 months. </li>
						<br>
						<li> <b> De-escalation: </b> You must be able to defuse heated situations efficiently and effectively. </li>
						<br>
					</ul>
					<input type="hidden" name="requirements" value="done">
					<input type="submit" value="I have read and met the requirements">
				</form>
				';
			}
			echo '</div>';
			include 'includes/footer.html';
			?>
		</div>
	</body>
</html>
