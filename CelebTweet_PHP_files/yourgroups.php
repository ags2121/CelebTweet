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

$query2 = "call groupsYouBelongTo('$user')";

$result2 = mysqli_query($dbcon, $query2)
	or die('Get groups failed: ' . mysqli_error($dbcon));

if($result2->num_rows==0){
	print "<i>You don't belong to any groups! Check out some groups in the menu above.</i>";
}

print '<ul>';
while ($tuple = mysqli_fetch_row($result2)) {
	print "<li>

	<a href=group_members.php?groupID=$tuple[1]&groupName=$tuple[0]><b>$tuple[0]</b></a>";

	}

print '</ul>';

//Closing connection
mysqli_close($dbcon);

?>
