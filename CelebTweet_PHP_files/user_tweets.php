<?php

session_start();

$user = $_SESSION['username'];
print "<h5>Logged in as <i>$user</i></h5>";

include 'header.php';

include 'menu.php';

print '<p>';

// Connection parameters
$host = 'cspp53001.cs.uchicago.edu';
$username = 'ags';
$password = '3c8yBrMc';
$database = 'agsDB';

$dbcon = mysqli_connect($host, $username, $password, $database)
or die('Could not connect: ' . mysqli_connect_error());

// Getting the input parameter (tweet text):
$text = $_REQUEST['tweet_text'];

if($text != null){

	//check if text is 140 characters or less
	   if(strlen($text) > 140 || strlen($text) < 1){
		print "<br>ERROR: Your tweet length is out of range. Please go back and enter a tweet within the range of 1 and 140 characters.";
	}

	$today = date("Y-m-d");

	$query = "call insertTweet('$user','$text', '$today')";

	$result = mysqli_query($dbcon, $query)
	or die('Get user failed: ' . mysqli_error($dbcon));

	//tests whether tweet was added
	/*  

	$query2 = "SELECT * FROM Tweet WHERE tweet_user_name = '$user'";

	$result2 = mysqli_query($dbcon, $query2)
	or die('<br>Get user failed: ' . mysqli_error($dbcon));

	$tuple2 = mysqli_fetch_row($result2);

	print "<br>$tuple2[1]";
	*/

}

// Closing connection
	mysqli_close($dbcon);
	?>

	<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
	<html> <head>
	<title>CelebTweet</title>
	</head>

	<h1>Your Tweets</h1><hr>

<?php

// Connection parameters
$host = 'cspp53001.cs.uchicago.edu';
$username = 'ags';
$password = '3c8yBrMc';
$database = 'agsDB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
	or die('Could not connect: ' . mysqli_connect_error());
		 
// Listing tables in your database 
$query2 = "SELECT * FROM Tweet WHERE tweet_user_name = '$user' ORDER BY time_stamp DESC";

$result2 = mysqli_query($dbcon, $query2)
	or die('Show user failed: ' . mysqli_error($dbcon));
			  

// Printing tweets in HTML
print '<ul>';
while ($tuple = mysqli_fetch_row($result2)) {
	print "<li> Text: <b>$tuple[2]</b> <br> Date: $tuple[3] <p>";
	}

print '</ul>';

// Free result
mysqli_free_result($result2);

// Closing connection
mysqli_close($dbcon);
?>

