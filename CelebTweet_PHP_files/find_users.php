<?php

session_start();
$user = $_SESSION['username'];
print "<h5>Logged in as <i>$user</i></h5>";

include 'header.php';

include 'menu.php';

print '<p>';

//Connection parameters
$host = 'cspp53001.cs.uchicago.edu';
$username = 'ags';
$password = '3c8yBrMc';
$database = 'agsDB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());

$query = "SELECT * FROM numUser";

$result = mysqli_query($dbcon, $query)
or die('Get user failed: ' . mysqli_error($dbcon));

$tuple = mysqli_fetch_row($result);

print "<h1>Find Users</h1><hr>";

print "<b>There are $tuple[0] users on CeLeBTwEeT. Enter a number to return a random amount of users to explore.</b><p>";

?>

<form method=get action="list_of_users.php">
Enter number (e.g. "10"):<br>
<input type="text" name="number"><BR>
<input type="submit" value="Submit">
</form>

<b>Already know somone on CeLeBTwEeT? Type in their username to find them!</b><p>

<form method=get action="tweets.php">
Enter username (e.g. "FredDD"):<br>
<input type="text" name="user"><BR>
<input type="submit" value="Submit">
</form>
