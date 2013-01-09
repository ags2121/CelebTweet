<?php

session_start();
$user = $_SESSION['username'];
print "<h5>Logged in as <i>$user</i></h5>";

include 'header.php';

include 'menu.php';

print '<p>';

//Connection params
$host = 'cspp53001.cs.uchicago.edu';
$username = 'ags';
$password = '3c8yBrMc';
$database = 'agsDB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());

// Listing celebrities in your database
	$query = "call groupsAndGroupTweet";
	$result = mysqli_query($dbcon, $query)
		or die('Show groups failed: ' . mysqli_error($dbcon));

	print "<h1>Groups</h1><hr>";

print '<ul>';

while ($tuple = mysqli_fetch_row($result)) {

	print "<li> Group Name: <a href=group_members.php?groupID=$tuple[1]&groupName=$tuple[2]><b>$tuple[2]</b></a> <br> 
		Category: $tuple[3] <br>
		Recent Tweet: $tuple[4] <br>
		<a href=group_members.php?groupID=$tuple[1]&joiner=$user&groupName=$tuple[2]>Join Group</a>
		<p>";
}

print '</ul>';

mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?>
