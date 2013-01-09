<?php

session_start();

$user = $_SESSION['username'];
$joiner = $_REQUEST['joiner'];
$groupID = $_REQUEST['groupID'];

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

if($joiner != null){

	$query = "INSERT IGNORE INTO Belongs VALUES('$joiner','$groupID')";
	$result = mysqli_query($dbcon, $query)
	or die('Insert belongs failed: ' . mysqli_error($dbcon));
}

$query2 = "call Belongs('$groupID')";

$result2 = mysqli_query($dbcon, $query2)
	or die('Show belongs failed: ' . mysqli_error($dbcon));

$tuple = mysqli_fetch_row($result2);


print "<h1>Users who Belong to <i>$tuple[1]</i></h1><hr>";

print '<ul>';

print "<li><a href=tweets.php?user=$tuple[0]><b>$tuple[0]</b></a> <br>";

while ($tuple = mysqli_fetch_row($result2)) {

	print "<li><a href=tweets.php?user=$tuple[0]><b>$tuple[0]</b></a> <br>";

}	

print '</ul>';

mysqli_free_result($result2);

// Closing connection
mysqli_close($dbcon);
?>

			  
	
