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
	$defaultdesc = mysql_real_escape_string(file_get_contents('default_desc.json'));
	mysql_query("INSERT INTO causes (uid,name,slug,started,banner,description,tags,hidden,deleted) VALUES('$userid','$causename','$slug','$date','placehold.gif','$defaultdesc','','1','0') ");

	echo '1:'.$slug.':Redirecting';
	exit;
?>