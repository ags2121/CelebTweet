<?php
session_start();
$user = $_SESSION['username'];
print "<h5>Logged in as <i>$user</i></h5>";

include 'header.php';

include 'menu.php';

print '<p>';

// Connection parameters
$host = 'cspp53001.cs.uchicago.edu';
$username = 'ags';
$password = '3c8yBrMc';
$database = 'agsDB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());

// Getting the input parameter (number):
   $num = $_REQUEST['number'];

// Listing tables in your database
	$query = "call RandomUsersPHP('$num')";

$result = mysqli_query($dbcon, $query)
        or die('Show users failed: ' . mysqli_error($dbcon));

print "<h1><b>$num</b> random users</h1><hr>";
		    
// Printing table names in HTML
        print '<ul>';
	while ($tuple = mysqli_fetch_row($result)) {
		print "<li> <a href=tweets.php?user=$tuple[1]><b>$tuple[1]</b></a> <br> 
		Name: $tuple[0]<p>";
		}
	print '</ul>';

// Free result
           mysqli_free_result($result);

// Closing connection
	mysqli_close($dbcon);
	?>
