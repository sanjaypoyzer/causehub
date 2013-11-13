<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	
	if(checkSession()){
		echo '1';
		exit;
	}

				echo '2:We are sorry, but no user signups are allowed in this version of the Alpha:Register';
				exit;
	

	$user = mysql_real_escape_string($_POST['user']);
	$pass = md5($_POST['pass']);
	$fname = mysql_real_escape_string($_POST['fname']);
	$lname = mysql_real_escape_string($_POST['lname']);
	$email = mysql_real_escape_string($_POST['email']);

	if($user==''){
		echo '2:No username entered:Register';
		exit;
	} else if($pass==''){
		echo '2:No password entered:Register';
		exit;
	} else if($fname==''){
		echo '2:No first name entered:Register';
		exit;
	} else if($lname==''){
		echo '2:No last name entered:Register';
		exit;
	} else if($email==''){
		echo '2:No email entered:Register';
		exit;
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    	echo '2:The email you entered is invalid:Register';
		exit;
	}

	$sql = mysql_query("SELECT * FROM users WHERE username='$user'");
	$usercheck = mysql_num_rows($sql);
	if($usercheck!=0){
		echo '2:Username already in use:Register';
		exit;
	}
	$sql = mysql_query("SELECT * FROM users WHERE email='$email'");
	$emailcheck = mysql_num_rows($sql);
	if($emailcheck!=0){
		echo '2:Email already in use:Register';
		exit;
	}

	mysql_query("INSERT INTO users (username,password,email,fname,lname) VALUES('$user','$pass','$email','$fname','$lname') ");

	echo '1::Registering';
	exit;
?>