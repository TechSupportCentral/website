<?php
require 'includes/config.php';
$thumbnail = "https://cdn.discordapp.com/avatars/" . $_POST['id'] . "/" . $_POST['avatar'] . $_POST['extension'];
$sql = mysqli_connect($db['host'], $db['user'], $db['pass'], $db['name'], (int)$db['port']);

if ($_POST['type'] == "support_team") {
	$title = "New Support Team Application";
	$color = hexdec("4df352");

	$specialty = "";
	for($i; $i <= 6; $i++) {
		if (isset($_POST['q3o'.$i])) {
			$specialty .= ", ".$_POST['q3o'.$i];
		}
	}
	if($specialty == "") {
		$specialty = "  None";
	}

	$query = "INSERT INTO support_team_applications (userid, username, q1, q2, q3, q4, q5) VALUES (" . $_POST['id'] . ", '" . $_POST['username'] . "', '" . $_POST['q1'] . "', '" . $_POST['q2'] . "', '" . substr($specialty, 2) . "', '" . $_POST['q4'] . "', '" . $_POST['q5'] . "');";
	$fields = [
		[
			"name" => "Submitted by:",
			"value" => $_POST['username'],
			"inline" => true
		],
		[
			"name" => "User ID:",
			"value" => $_POST['id'],
			"inline" => true
		],
		[
			"name" => "Are you currently or have you previously provided Tech Support in any other discord servers or a real life career?",
			"value" => $_POST['q1'],
			"inline" => false
		],
		[
			"name" => "Are you able to be active on the server at least 2-3 times a week?",
			"value" => $_POST['q2'],
			"inline" => false
		],
		[
			"name" => "What do you specialize in?",
			"value" => substr($specialty, 2),
			"inline" => false
		],
		[
			"name" => "Are you confident in giving advice and offering support?",
			"value" => $_POST['q4'],
			"inline" => false
		],
		[
			"name" => "Are you okay with notifying other Support Team members if you are unsure how to deal with a case that you are involved in?",
			"value" => $_POST['q5'],
			"inline" => false
		]
	];
} elseif ($_POST['type'] == "moderator") {
	$title = "New Moderator Application";
	$color = hexdec("3498db");
	$query = "INSERT INTO moderator_applications (userid, username, q1, q2, q3, q4, q5, q6, q7) VALUES (" . $_POST['id'] . ", '" . $_POST['username'] . "', '" . $_POST['q1'] . "', '" . $_POST['q2'] . "', '" . $_POST['q3'] . "', '" . $_POST['q4'] . "', '" . $_POST['q5'] . "', '" . $_POST['q6'] . "', '" . $_POST['q7'] . "');";
	$fields = [
		[
			"name" => "Submitted by:",
			"value" => $_POST['username'],
			"inline" => true
		],
		[
			"name" => "User ID:",
			"value" => $_POST['id'],
			"inline" => true
		],
		[
			"name" => "If a member is doing something against our rules (i.e. spamming, sending NSFW), what do you do?",
			"value" => $_POST['q1'],
			"inline" => false
		],
		[
			"name" => "If you or another member receives self promotion, what do you do?",
			"value" => $_POST['q2'],
			"inline" => false
		],
		[
			"name" => "If a member asks for help or advice with cracked/illegal content, what do you do?",
			"value" => $_POST['q3'],
			"inline" => false
		],
		[
			"name" => "We ask you to enable Developer Mode in Discord settings so you can retrieve a user ID to make it easier to sanction a member.",
			"value" => $_POST['q4'],
			"inline" => false
		],
		[
			"name" => "If your Mod application gets accepted, you will temporarily receive a \"Trial Moderator\" role which is a trial period to see if this role is for you.",
			"value" => $_POST['q5'],
			"inline" => false
		],
		[
			"name" => "Applying for this role means that you have the opportunity to become a Moderator; if you wish to be a Support Team member as well then you can apply via the Support Team application form.",
			"value" => $_POST['q6'],
			"inline" => false
		],
		[
			"name" => "As a moderator, you will have to adhere and follow the rules.",
			"value" => $_POST['q7'],
			"inline" => false
		]
	];
} elseif ($_POST['type'] == "appeal") {
	$title = "New Ban Appeal";
	$color = hexdec("e74c3c");
	$query = "INSERT INTO appeals (userid, username, email, q1, q2) VALUES (" . $_POST['id'] . ", '" . $_POST['username'] . "', '" . $_POST['email'] . "', '" . mysqli_real_escape_string($sql, $_POST['q1']) . "', '" . mysqli_real_escape_string($sql, $_POST['q2']) . "');";
	$fields = [
		[
			"name" => "Submitted by:",
			"value" => $_POST['username'],
			"inline" => true
		],
		[
			"name" => "User ID:",
			"value" => $_POST['id'],
			"inline" => true
		],
		[
			"name" => "Contact Email:",
			"value" => $_POST['email'],
			"inline" => false
		],
		[
			"name" => "Why were you banned?",
			"value" => $_POST['q1'],
			"inline" => false
		],
		[
			"name" => "Why do you disagree with the reasoning for your ban?",
			"value" => $_POST['q2'],
			"inline" => false
		]
	];
}

$json_data = json_encode([
	"embeds" => [
		[
			"title" => $title,
			"type" => "rich",
			"color" => $color,
			"thumbnail" => [
				"url" => $thumbnail
			],
			"fields" => $fields
		]
	]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


$ch = curl_init( $webhook_url );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
curl_close( $ch );

mysqli_query($sql, $query);
mysqli_close($sql);

if ($response == "") {
	$success = "done";
} else {
	$success = "fail";
}

if ($_POST['type'] == "support_team") {
	header('Location: support-team.php?form='.$success);
} elseif ($_POST['type'] == "moderator") {
	header('Location: moderator.php?form='.$success);
} elseif ($_POST['type'] == "appeal") {
	header('Location: appeal.php?form='.$success);
} else {
	header('Location: index.php');
}

?>
