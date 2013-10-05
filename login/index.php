<?php
	session_start();
	include ('../scripts/connect.php');
	include ('../scripts/functions.php');

	if(checkSession()){header('location:/');}
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="/scripts/login.js"></script>

<script src="/plugins/alertify/alertify.js"></script>
<link rel="stylesheet" href="/plugins/alertify/alertify.core.css" />
<link rel="stylesheet" href="/plugins/alertify/alertify.default.css" />

<?php

	echo getCurrentUserInfo('username');
?>

<form method='post' action='#' onsubmit="return false;">
    <input type="text" id="u" name="username" placeholder="Username" />
    <input type="password" id="p" name="password" placeholder="Password" />
    <input type="submit" class='submit right' id='signinbtn' value='Login' onclick='login(); return false;'>
</form>