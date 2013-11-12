<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	
	if(checkSession()){
		header('location:/');
		exit;
	}

	$resetcode = $_POST['resetcode'];
	$password = $_POST['password'];

	if($resetcode==''){
		$_SESSION['forgot_msg'] = 'error:You didnt enter a reset code';
		header('location:/login/newpass/');
		exit;
	}

	if($password==''){
		$_SESSION['forgot_msg'] = 'error:No new password entered';
		header('location:/login/newpass/');
		exit;
	}

	$password = md5($password);

	$sql = mysql_query("SELECT uid FROM passreset WHERE resetcode='$resetcode' AND valid='1'");
	$codecheck = mysql_num_rows($sql);
	if($codecheck==0){
		$_SESSION['forgot_msg'] = 'error:There was an error with the code provided';
		header('location:/login/newpass/');
		exit;
	}
	$row = mysql_fetch_row($sql);
	$userid = $row[0];

	$timedate = date("H:i:s d-m-Y");

	mysql_query("UPDATE users SET password='$password' WHERE (id='$userid')");
	mysql_query("UPDATE passreset SET valid='0' WHERE (uid='$userid')");
	mysql_query("UPDATE passreset SET timedate_used='$timedate' WHERE (resetcode='$resetcode')");
	$_SESSION['forgot_msg'] = 'success:Your password has been reset';
	header('location:/login/');
	exit;
?>