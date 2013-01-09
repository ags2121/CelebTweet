<?php

session_start();
$user = $_SESSION['username'];

//Connection params
$host = 'cspp53001.cs.uchicago.edu';
$username = 'ags';
$password = '3c8yBrMc';
$database = 'agsDB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());

$query2 = "call recentRetweet('$user')";

$result2 = mysqli_query($dbcon, $query2)
	or die('Get groups failed: ' . mysqli_error($dbcon));

if($result2->num_rows==0){
	print "<i>You've never retweeted! Check out some tweets in the menu above.</i>";
}

print '<ul>';
while ($tuple = mysqli_fetch_row($result2)) {
	print "<li>

	Username: <a href=tweets.php?user=$tuple[0]><b>$tuple[0]</b> </a> <br>
	Text: $tuple[1]<br>
	Retweeted on: $tuple[3]<br>
	Tweeted on: $tuple[2]";
	}
print '</ul>';

//Closing connection
mysqli_close($dbcon);

?>
