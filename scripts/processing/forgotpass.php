<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	
	if(checkSession()){
		header('location:/');
		exit;
	}

	$username = $_POST['username'];

	if($username==''){
		$_SESSION['forgot_msg'] = 'error:You did not enter a username';
		header('location:/login/forgot/');
		exit;
	}

	$sql = mysql_query("SELECT id,email FROM users WHERE username='$username'");
	$usercheck = mysql_num_rows($sql);
	if($usercheck==0){
		$_SESSION['forgot_msg'] = 'error:The username entered did not match anything in our records';
		header('location:/login/forgot/');
		exit;
	}
	$row = mysql_fetch_row($sql);
	$userid = $row[0];
	$email = $row[1];

	function str_rand($length = 8, $seeds = 'alphanum'){
		$seedings['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
		$seedings['numeric'] = '0123456789';
		$seedings['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';
		$seedings['hexidec'] = '0123456789abcdef';
		if (isset($seedings[$seeds])){$seeds = $seedings[$seeds];}
		list($usec, $sec) = explode(' ', microtime());
		$seed = (float) $sec + ((float) $usec * 100000);
		mt_srand($seed);
		$str = '';
		$seeds_count = strlen($seeds);
		for ($i = 0; $length > $i; $i++){$str .= $seeds{mt_rand(0, $seeds_count - 1)};}
		return $str;
	}
	$timedate = date("H:i:s d-m-Y");
	$ip = $_SERVER['REMOTE_ADDR'];
	$resetcode = str_rand(15, 'alphanum');

	mysql_query("UPDATE passreset SET valid='0' WHERE (uid='$userid')");
	mysql_query("INSERT INTO passreset (uid,resetcode,timedate_created,ip,valid) VALUES('$userid','$resetcode','$timedate','$ip','1') ");

	$to = $email;
	$subject = 'Your reset password code';
	$headers = "From: noreply@causehub.co\r\n";
	$headers .= "Reply-To: support@causehub.co\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$message = '<html><body>';
	$message .= '<p>You password can now be reset on CauseHub <a href="http://causehub.co/login/newpass">here</a><br>Your password reset code is: <b>'.$resetcode.'</b></p';
	$message .= '</body></html>';
	mail($to, $subject, $message, $headers);

	$_SESSION['forgot_msg'] = 'success:A reset code has been sent to you email ('.$email.')';
	header('location:/login/newpass/');
	exit;
?>