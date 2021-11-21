<?php
require 'includes/discord.php';
require 'includes/config.php';

init("https://www.techsupportcentral.cf/support-team.php", $client_id, $secret_id);
get_user();
?>

<html>
	<head>
		<title> Support Team Application | Tech Support Central </title>
		<style>
			#MainBody {
			height: 550px;
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
				<form action="submit-form.php" method=”post”>
					<label for="q1"> Are you currently or have you previously provided Tech Support in any other discord servers or a real life career? </label><br>
					<input type="radio" id="q1o1" name="q1" value="Yes, I currently do.">
					<label for="q1o1"> Yes, I currently do. </label><br>
					<input type="radio" id="q1o2" name="q1" value="I have in the past.">
					<label for="q1o2"> I have in the past. </label><br>
					<input type="radio" id="q1o3" name="q1" value="No, not before.">
					<label for="q1o3"> No, not before. </label><br>
					<br>
					<label for="q2"> Are you able to be active on the server at least 2-3 times a week? </label><br>
					<input type="radio" id="q2o1" name="q2" value="Yes">
					<label for="q2o1"> Yes </label><br>
					<input type="radio" id="q2o2" name="q2" value="No">
					<label for="q2o2"> No </label><br>
					<br>
					<label for="q3"> What do you specialize in? </label><br>
					<input type="radio" id="q3o1" name="q3" value="Software">
					<label for="q3o1"> Software </label><br>
					<input type="radio" id="q3o2" name="q3" value="Hardware">
					<label for="q3o2"> Hardware </label><br>
					<input type="radio" id="q3o3" name="q3" value="PC Builds">
					<label for="q3o3"> PC Builds </label><br>
					<input type="radio" id="q3o4" name="q3" value="Mobile">
					<label for="q3o4"> Mobile </label><br>
					<input type="radio" id="q3o5" name="q3" value="A little bit of everything">
					<label for="q3o5"> A little bit of everything </label><br>
					<br>
					<label for="q4"> Are you confident in giving advice and offering support? </label><br>
					<input type="radio" id="q4o1" name="q4" value="Yes">
					<label for="q4o1"> Yes </label><br>
					<input type="radio" id="q4o2" name="q4" value="No">
					<label for="q4o2"> No </label><br>
					<br>
					<label for="q5"> Are you okay with notifying other Support Team members if you are unsure with how to deal with a case that you are involved in? </label><br>
					<input type="radio" id="q5o1" name="q5" value="Yes">
					<label for="q5o1"> Yes </label><br>
					<input type="radio" id="q5o2" name="q5" value="No">
					<label for="q5o2"> No </label><br>
					<br>
					<input type="hidden" name="username" value=' . $_SESSION['username'] . '>
					<input type="hidden" name="id" value=' . $_SESSION['user_id'] . '>
					<input type="hidden" name="avatar" value=' . $_SESSION['user_avatar'] . '>
					<input type="hidden" name="extension" value=' . $extension . '>
					<input type="hidden" name="type" value="support_team">
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
					<a href=' . url($client_id, "https://www.techsupportcentral.cf/support-team.php", "identify") . '> <img src="login.png", width=512, height=107> </a>
				</div>
				';
			}
			echo '</div>';
			include 'includes/footer.php';
			?>
		</div>
	</body>
</html>
