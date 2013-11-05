<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	
	$name = mysql_real_escape_string($_POST['name']);
	$email = mysql_real_escape_string($_POST['email']);
	$message = mysql_real_escape_string($_POST['msg']);
	$ip = $_SERVER['REMOTE_ADDR'];
	$timedate = date("H:i:s d-m-Y");

	if($name==''){
		echo '2:Please enter your name to submit feedback';
		exit;
	}

	if($email==''){
		echo '2:Please enter your email to submit feedback';
		exit;
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    	echo '2:Please enter a valid email to submit feedback';
		exit;
	}

	if($message==''){
		echo '2:Please enter a message to submit feedback';
		exit;
	}

	mysql_query("INSERT INTO feedback (name,email,message,ip,timedate) VALUES('$name','$email','$message','$ip','$timedate')");

	echo '1';
	exit;
?>