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

$query2 = "call allTweetsFromFollowees('$user')";

$result2 = mysqli_query($dbcon, $query2)
	or die('Get groups failed: ' . mysqli_error($dbcon));

if($result2->num_rows==0){
	print "<i>You don't follow anyone! You need to follow some peeps in order to populate your 'Wall'</i>";
}

print '<ul>';
while ($tuple = mysqli_fetch_row($result2)) {
	print 

	"<li>Username: <a href=tweets.php?user=$tuple[1]><b>$tuple[1]</b></a> <br> 
		
		Text: $tuple[2] <br>
		Tweet Date: $tuple[3] <br>
		<a href=retweets.php?ID=$tuple[0]>Retweet</b></a> <p>";

	}

print '</ul>';

//Closing connection
mysqli_close($dbcon);

?>
