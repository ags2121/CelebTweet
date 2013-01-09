<?php

session_start();
$username = $_SESSION['username'];
print "<h5>Logged in as <i>$username</i></h5>";

include 'menu.php';

include 'header.php';

print '<p>';

//Connection params
$host = 'cspp53001.cs.uchicago.edu';
$username = 'ags';
$password = '3c8yBrMc';
$database = 'agsDB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());

// Getting the input parameter (TP or Celeb):
$TP = $_REQUEST['TP'];
$Celeb = $_REQUEST['Celeb'];


if($Celeb==null){

// Getting TP/Celeb partnership by TP input
	$query = "SELECT Celebrity_Celebrity_user_name, Twitter_President_user_name, Cause
			FROM Partners 
			WHERE Twitter_President_user_name = '$TP'";
	$result = mysqli_query($dbcon, $query)
		or die('Show celebrities failed: ' . mysqli_error($dbcon));
}

else{

	// Getting TP/Celeb partnership by Celeb input
	$query = "SELECT Celebrity_Celebrity_user_name, Twitter_President_user_name, Cause
			FROM Partners 
			WHERE Celebrity_Celebrity_user_name = '$Celeb'";

	$result = mysqli_query($dbcon, $query)
		or die('Show celebrities failed: ' . mysqli_error($dbcon));
}

	print "<h1>Twitter President/Celebrity Partnerships</h1><hr>";
	
	// Printing table names in HTML
	print '<ul>';
	while ($tuple = mysqli_fetch_row($result)) {
			print "<li> Celebrity: <a href=tweets.php?user=$tuple[0]><b>$tuple[0]</b></a> <br> 

			Twitter President: <a href=tweets.php?user=$tuple[1]><b>$tuple[1]</b></a> <br> 

			Charitable Cause: <b>$tuple[2]</b> <p>";

			}

	print '</ul>';

// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
	?>

