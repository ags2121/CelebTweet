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

// Listing celebrities in your database
	$query = "SELECT * FROM Twitter_President ORDER BY reign_date DESC";
	$result = mysqli_query($dbcon, $query)
		or die('Show celebrities failed: ' . mysqli_error($dbcon));

	print "<h1>Twitter Presidents</h1><hr>";
	
	// Printing table names in HTML
	        print '<ul>';
		while ($tuple = mysqli_fetch_row($result)) {
			print "<li> Username: <a href=tweets.php?user=$tuple[1]><b>$tuple[1]</b></a> <br> 

			Name: $tuple[2] <br>

			Reign Date: $tuple[3] <br>

			Retweet Percent Increase: $tuple[4] <br> 

			<a href=partners.php?TP=$tuple[1]>Celebrity Partner</a> <p>";

			}

		print '</ul>';

// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
	?>

