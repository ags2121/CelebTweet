<?php

session_start();
$user = $_SESSION['username'];
print "<h5>Logged in as <i>$username</i></h5>";

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
	$query = "SELECT * FROM Celebrity";
	$result = mysqli_query($dbcon, $query)
		or die('Show celebrities failed: ' . mysqli_error($dbcon));

	print "<h1>Celebrities</h1><hr>";
	
	// Printing table names in HTML
	        print '<ul>';
		while ($tuple = mysqli_fetch_row($result)) {
			print "<li> Username:

			<a href=tweets.php?user=$tuple[1]><b>$tuple[1]</b></a> <br> 

			Name: $tuple[2] <br>

			Price to view: $tuple[3] <br>

			Font size: $tuple[4] <br>

			<a href=partners.php?Celeb=$tuple[1]>Twitter President Partner</a> <p>";

			}

		print '</ul>';

// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
	?>

