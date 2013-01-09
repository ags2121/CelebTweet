<?php

session_start();

$user = $_SESSION['username'];
$leader = $_REQUEST['leader'];

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

if($leader != null){

	$query = "call addFollows('$user', '$leader')";
	$result = mysqli_query($dbcon, $query)
	or die('Insert retweet failed: ' . mysqli_error($dbcon));
}
	

$query2 = "call recentTweetFromFollowees('$user')";

$result2 = mysqli_query($dbcon, $query2)
	or die('Show retweets failed: ' . mysqli_error($dbcon));

print "<h1>People you Follow</h1><hr>";

print '<ul>';

while ($recentT = mysqli_fetch_row($result2)) {

	print "<li>Username: <a href=tweets.php?user=$recentT[1]><b>$recentT[1]</b></a> <br> 
		
		Most Recent Tweet: $recentT[2] <br>
		Tweet Date: $recentT[3] <br>
		<a href=retweets.php?ID=$recentT[0]>Retweet</b></a> <p>";

}	

print '</ul>';

mysqli_free_result($result2);

// Closing connection
mysqli_close($dbcon);
?>

			  
	
