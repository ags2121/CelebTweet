<?php

session_start();
$user = $_SESSION['username'];
print "<h5>Logged in as <i>$user</i></h5>";

include 'header.php';

include 'menu.php';

print '<p>';

//Connection parameters
$host = 'cspp53001.cs.uchicago.edu';
$username = 'ags';
$password = '3c8yBrMc';
$database = 'agsDB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());

// Getting the input parameter (user):
$tweeter = $_REQUEST['user'];

 //return all tweets of specified user in chronological order
$query = "call allTweets('$tweeter')";
$result = mysqli_query($dbcon, $query)
	or die('Query failed: ' . mysqli_error($dbcon));

if($result->num_rows==0){
	print "<i>User doesn't exist or is inactive! Go back and enter a valid username</i>";
}

print "<h1><b>$tweeter's</b> Tweets<br></h1><hr><p>";

$tuple = mysqli_fetch_row($result);

print "Name: $tuple[4]<br>";

print "<a href=following.php?leader=$tweeter> Follow <i>$tweeter</i> </b> </a>";

	print '<ul>';
	print "<li>Text: <b>$tuple[2]</b> <br> Date: $tuple[3] <br>
	<a href=retweets.php?ID=$tuple[0]>Retweet</a><br>
	<p>";


	while ($tuple = mysqli_fetch_row($result)) {
		print "<li>Text: <b>$tuple[2]</b> <br> Date: $tuple[3] <br>
			<a href=retweets.php?ID=$tuple[0]>Retweet</a><br>
			<p>";
		
			}
		print '</ul>';


// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?>
