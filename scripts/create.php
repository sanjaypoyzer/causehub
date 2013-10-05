<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	
	if(!checkSession()){
		echo '3:You need to be logged in the create a cause:Create';
		exit;
	}

	$causename = $_POST['causename'];
	$userid = getCurrentUserInfo('id');

	if($causename==''){
		echo '2:No cause name entered:Create';
		exit;
	}

	$date = date("d-m-Y");
	$slug = rand(10000,99999);

	$causename = mysql_real_escape_string($causename);
	$defaultdesc = mysql_real_escape_string('Fill this space with the story behind your cause. Basic HTML allowed. Embed images &amp; video to help your cause stand out.');
	mysql_query("INSERT INTO causes (uid,name,slug,started,description,category,hidden,deleted) VALUES('$userid','$causename','$slug','$date','$defaultdesc','','1','0') ");

	echo '1:'.$slug.':Redirecting';
	exit;
?>