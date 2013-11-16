<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	
	if(checkSession()){
		echo '1';
		exit;
	}
	
	$u = $_POST['u'];
	$p = md5($_POST['p']);
	$sql = mysql_query("SELECT id,username FROM users WHERE username='$u' AND password='$p'");
	$logincheck = mysql_num_rows($sql);
	if($logincheck==0){
		echo '2:The user/pass entered is incorrect:Login';
		exit;
	}
	$row = mysql_fetch_row($sql);
	$userid = $row[0];
	$user = $row[1];
			
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
		
	$sid = str_rand(10, 'alphanum');
	$_SESSION['id'] = $sid;
		
	$timedate = date("H:i:s d-m-Y");
	$ip = $_SERVER['REMOTE_ADDR'];

	$nextpathitem = count($_SESSION['path']);
    $_SESSION['path'][$nextpathitem]['uri'] = 'login.entry.script';
    $_SESSION['path'][$nextpathitem]['timedate'] = date("Y-m-d")." ".strftime("%H:%M:%S");
    $path_string = mysql_real_escape_string(serialize($_SESSION['path']));

    mysql_query("INSERT INTO sessions (uid,sid,ip,path,timedate,killed) VALUES('$userid','$sid','$ip','$path_string','$timedate','0') ");

	echo '1::Redirecting';
	exit;
?>