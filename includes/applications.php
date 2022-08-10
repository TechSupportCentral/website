<?php
require 'includes/discord.php';
require 'includes/config.php';

$name = basename($_SERVER['PHP_SELF']);
init("https://www.techsupportcentral.cf/" . $name, $client_id, $secret_id);
if ($name == "appeal.php") {get_user(true);} else {get_user();}
get_joined_at();

// Check if user's account creation and server join dates meet requirements
function age_check($min_age, $min_join) {
	// Convert user ID to binary
	$bin = decbin($_SESSION['user_id']);
	// Extract user creation date (first 38 digits)
	$sub = substr($bin, 0, 38);
	/* Convert the substring back to base 10
	 * Divide by 1000 (milliseconds to seconds)
	 * Add 45 years worth of seconds to convert from Discord timestamp
	   (seconds since 2015) to Unix timestamp (seconds since 1970)
	 */
	$epoch = bindec($sub) / 1000 + 1420070400;

	// Check if user creation date is newer than minimum
	if ($epoch > (time() - $min_age)) {
		return 1;
	// Check if user's join date is newer than minimum
	} elseif (strtotime($_SESSION['joined_at']) > (time() - $min_join)) {
		return 2;
	}
	// If neither check triggered, requirements are met
	return 0;
}

// Check if user has already submitted an application
function submission_check($table, $id, $db) {
	// Initialize database of applications; return 0 if it fails to connect
	$sql = mysqli_connect($db['host'], $db['user'], $db['pass'], $db['name'], (int)$db['port']);
	if (mysqli_connect_errno()) {return 0;}

	// Check for applications from the user
	$result = mysqli_query($sql, 'SELECT * FROM ' . $table . ' WHERE userid = ' . $id);

	// return number of rows
	$status = mysqli_num_rows($result);

	// Free result, close database, and return status
	mysqli_free_result($result);
	mysqli_close($sql);
	return $status;
}
?>
