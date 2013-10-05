<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	
	$sid = $_SESSION['id'];
	unset($_SESSION);
	mysql_query("UPDATE sessions SET killed='1' WHERE (sid='$sid')");
	header('location:/login');
?>