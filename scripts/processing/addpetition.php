<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');

	$postpid = $_POST['pid'];
	$postfname = $_POST['fname'];
	$postlname = $_POST['lname'];
	$postemail = $_POST['email'];
	
	$postfname = mysql_real_escape_string($postfname);
	$postlname = mysql_real_escape_string($postlname);
	$postemail = mysql_real_escape_string($postemail);

	$timedate = date("H:i:s d-m-Y");
	$ip = $_SERVER['REMOTE_ADDR'];

	//mysql_query("INSERT INTO petition_signatures (pid,fname,lname,email,timedate,ip,show) VALUES('$postpid','$postfname','$postlname','$postemail','$timedate','$ip','$postshow') ");
	mysql_query("INSERT INTO petition_signatures (pid,fname,lname,email,timedate,ip) VALUES('$postpid','$postfname','$postlname','$postemail','$timedate','$ip') ");

	echo '1:Thank you for signing this petition:Added';
	exit;
?>