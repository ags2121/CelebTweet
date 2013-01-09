<?php

session_start();

$isRegistered = true;

// Connection parameters
$host = 'cspp53001.cs.uchicago.edu';
$username = 'ags';
$password = '3c8yBrMc';
$database = 'agsDB';

$dbcon = mysqli_connect($host, $username, $password, $database)
or die('Could not connect: ' . mysqli_connect_error());

if ($_SESSION['username'] != null){
	$username = $_SESSION['username'];
}
else{
	// Getting the input parameters (username):
	$username = $_REQUEST['username'];
}

if(strlen($username) > 15 || strlen($username) < 1){
print "ERROR: Username not registered! Please go back and register as a new user.<br>";
$isRegistered = false;
}

else {

	// Checking to see if user doesn't exist
	$query = "SELECT * FROM User WHERE user_name = '$username'";

	$result = mysqli_query($dbcon, $query)
		or die('Get user failed: ' . mysqli_error($dbcon));

	$tuple = mysqli_fetch_row($result);

	if(strlen($tuple)==0){
	print "ERROR: Username not registered! Please go back and register as a new user.<br>";
	$isRegistered = false;
	}
}

if($isRegistered){

	$_SESSION['username'] = $username;

	include 'header.php';

	print "<h5>Logged in as <i>$username</i></h5>";

	include 'menu.php';

	print "<h1>$username's Home Page</h1><hr>";

	print "<h4>Your recent tweet:</h4>";

	$query = "call MostRecentTweet('$username')";

	$result = mysqli_query($dbcon, $query)
		or die('Get user failed: ' . mysqli_error($dbcon));

	if($result->num_rows==0){
		print "<i>You don't have any tweets! Write your first tweet above.</i>";
	}

	print '<ul>';
	while ($tuple = mysqli_fetch_row($result)) {
	print "<li> Text: <b>$tuple[2]</b> <br> Tweeted on: $tuple[3] <p>";
	}

	print '</ul>';

	//Closing connection
	mysqli_close($dbcon);

	print "<h4>Your recent retweet:</h4>";

	include 'recentRetweet.php';

	print "<h4>Groups you belong to:</h4>";

	include 'yourgroups.php';

	print "<h4>Your 'Wall':</h4>";

	include 'wall.php';

	}
?>
