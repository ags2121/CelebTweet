<?php

session_start();

$user = $_SESSION['username'];
$ID = $_REQUEST['ID'];

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

if($ID != null){

	$today = date("Y-m-d");
	$query = "call insertRetweet('$user', '$ID', '$today')";
	$result = mysqli_query($dbcon, $query)
	or die('Insert retweet failed: ' . mysqli_error($dbcon));
}

$query2 = "call Retweets('$user')";

$result2 = mysqli_query($dbcon, $query2)
	or die('Show retweets failed: ' . mysqli_error($dbcon));


print "<h1>Your Retweets</h1><hr>";

// Printing retweets
print '<ul>';
while ($tuple = mysqli_fetch_row($result2)) {
	print "<li>Username: <a href=tweets.php?user=$tuple[0]><b>$tuple[0]</b></a> <br> 		
		Text: $tuple[1] <br>
		Tweet Date: $tuple[2] <br>
		Retweet Date: $tuple[3] <p>";
	}

print '</ul>';

// Closing connection
mysqli_close($dbcon);
?>

			  
	


