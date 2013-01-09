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
	$query = "call MostRetweetedTweet()";
	$result = mysqli_query($dbcon, $query)
		or die('Show most retweeted tweet failed: ' . mysqli_error($dbcon));

	print "<h1>Top Users</h1><hr>";
	
	print "<h4>Most retweeted tweet(s):</h4>";
	
	// Printing table names in HTML
	print '<ul>';
	while ($tuple = mysqli_fetch_row($result)) {
		print "<li> Username: <a href=tweets.php?user=$tuple[1]><b>$tuple[1]</b></a> <br> 
		Tweet: <b>$tuple[2]</b> <br>
		Retweeted: <b>$tuple[3]</b> times. <br>
		<a href=retweets.php?ID=$tuple[0]>Retweet</b></a> <br> <p>";
	}
	print '</ul>';

// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
	?>

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


$query2 = "call tweetsTheMost()";
$result2 = mysqli_query($dbcon, $query2)
or die('Show tweets the most failed: ' . mysqli_error($dbcon));

print "<h4>User(s) who tweets the most:</h4>";


print '<ul>';
while ($tuple = mysqli_fetch_row($result2)){
	print "<li> <a href=tweets.php?user=$tuple[0]><b>$tuple[0]</b></a>

	has tweeted <b>$tuple[1]</b> times. <br>";
}

print '</ul>';

// Closing connection
mysqli_close($dbcon);
	?>

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


$query2 = "call mostFollowers()";
$result2 = mysqli_query($dbcon, $query2)
or die('Show tweets the most failed: ' . mysqli_error($dbcon));

print "<h4>User(s) with the most followers:</h4>";

print '<ul>';
while ($tuple = mysqli_fetch_row($result2)){
	print "<li> <a href=tweets.php?user=$tuple[0]><b>$tuple[0]</b></a>

	has <b>$tuple[1]</b> followers. <br>";
}
print '</ul>';


// Closing connection
mysqli_close($dbcon);
	?>
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


$query2 = "call followsTheMost()";
$result2 = mysqli_query($dbcon, $query2)
or die('Show tweets the most failed: ' . mysqli_error($dbcon));

print "<h4>User(s) who follows the most people:</h4>";

print '<ul>';
while ($tuple = mysqli_fetch_row($result2)){
	print "<li> <a href=tweets.php?user=$tuple[0]><b>$tuple[0]</b></a>

	follows <b>$tuple[1]</b> people. <br>";
}
print '</ul>';


// Closing connection
mysqli_close($dbcon);
	?>

