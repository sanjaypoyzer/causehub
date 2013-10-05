<?php
	session_start();
	include ('scripts/connect.php');
	include ('scripts/functions.php');

	if(checkSession()){echo 'Logged in';}
?>
index