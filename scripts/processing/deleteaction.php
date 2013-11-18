<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	
	if(!checkSession()){
		echo '2:You need to be logged in to edit this cause:Add Action';
		exit;
	}

	$postcauseid = $_POST['cid'];
	$postactionid = $_POST['aid'];
	$userid = getCurrentUserInfo('id');

	$sql = mysql_query("SELECT id,uid,name,slug,description FROM causes WHERE id='$postcauseid'");
	
	$row = mysql_fetch_array($sql);
	$causeid = $row['id'];
	$ownerid = $row['uid'];
	$causename = $row['name'];
	$causedescription = $row['description'];
	$causestart = $row['started'];
	$causeslug = $row['slug'];

	if($ownerid!=getCurrentUserInfo('id') && !checkAdmin()){
		exit;
	}

	mysql_query("UPDATE actionbase SET deleted='1' WHERE (id='$postactionid')");
	exit;
?>