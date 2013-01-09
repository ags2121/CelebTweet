<?php
session_start();
session_destroy();
?>


<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html> <head>
<title>CelebTweet</title>
</head>

<body>
<h1>WelCoMe tO CeLEbTweEtS</h1>

<hr>
<ul>
Type in your username to log in.
<p>

<form method=get action="home_page.php">
<b>Enter username</b>:<br>
<input type="text" name="username"><BR>
<input type="submit" value="Login">
</form>
</ul>

<hr>
<ul>
Not registered yet? Just type in your legal name and pick a username. It's that simple!
<p>

<form method=get action="new_user_page.php">
<b>Enter name</b> (between 1 and 30 characters):<br>
<input type="text" name="name"><BR>
<b>Enter username</b> (between 1 and 15 characters):<br>
<input type="text" name="username"><BR>
<input type="submit" value="Register">
</form>
</ul>

</body>
</html>
