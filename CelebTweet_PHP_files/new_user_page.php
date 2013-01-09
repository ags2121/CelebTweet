<?php

session_start();

// Connection parameters
$host = 'cspp53001.cs.uchicago.edu';
$username = 'ags';
$password = '3c8yBrMc';
$database = 'agsDB';

$dbcon = mysqli_connect($host, $username, $password, $database)
or die('Could not connect: ' . mysqli_connect_error());

// Getting the input parameters (username, name):
$username = $_REQUEST['username'];
$name = $_REQUEST['name'];

if (strlen($username) > 15 || strlen($username) < 1){
print "ERROR: Your username length is out of range. Please go back and enter a username within the range of 1 and 15 characters.";
}

if (strlen($name) > 30 || strlen($name) < 1){
print "<br>ERROR: Your name length is out of range. Please go back and enter a username within the range of 1 and 30 characters.";
}   
    
// Checking to see if user exists already 
$query = "SELECT * FROM User WHERE user_name = '$username'";

$result = mysqli_query($dbcon, $query)
	or die('Get user failed: ' . mysqli_error($dbcon));

$tuple = mysqli_fetch_row($result);

if(strlen($tuple)!=0){
print "<br>ERROR: Username exists! Please go back and enter a unique username.";
}
        
else{
        
	$query = "call insertUser('$username', '$name')";
	$result = mysqli_query($dbcon, $query)
	or die('Insert user failed: ' . mysqli_error($dbcon));

}

$_SESSION['username'] = $username;
$username = $_REQUEST['username'];
print "<h5>Logged in as <i>$username</i></h5>";

include 'header.php';

include 'menu.php';

//Closing connection
mysqli_close($dbcon);
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html> <head>
<title>CelebTweet</title>
</head>

<body>
<h1>Success! Let's Get Started:</h1>

<hr>
Write your first tweet!
<p>

<form method=get action="user_tweets.php">
<b>What's on your mind?</b><br>
<input type="text" name="tweet_text"><BR>
<input type="submit" value="Tweet!">
</form>

</body>
</html>

