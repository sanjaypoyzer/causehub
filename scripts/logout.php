<?php
	session_start();
	include('connect.php');
	include('functions.php');
	
	$sid = $_SESSION['id'];
	unset($_SESSION);
	mysql_query("UPDATE sessions SET killed='1' WHERE (sid='$sid')");
	header('location:/login');
?>