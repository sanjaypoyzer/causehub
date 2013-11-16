<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');

	$postcauseid = $_GET['cid'];
	$postcontent = $_POST['content'];
	$userid = getCurrentUserInfo('id');

	$sql = mysql_query("SELECT id,uid,name,slug,description,tags FROM causes WHERE id='$postcauseid'");
	$logincheck = mysql_num_rows($sql);
	
	$row = mysql_fetch_array($sql);
	$causeid = $row['id'];
	$ownerid = $row['uid'];
	$causename = $row['name'];
	$causedescription = $row['description'];
	$causetags = $row['tags'];
	$causestart = $row['started'];
	$cslug = $row['slug'];

	if(!checkSession()){
		header('location:/cause/'.$cslug.'/');
		exit;
	}

	if($ownerid!=getCurrentUserInfo('id') && !checkAdmin()){
		header('location:/cause/'.$cslug.'/');
		exit;
	}

	if($postcontent!=''){
		$content = mysql_real_escape_string($postcontent);
		mysql_query("UPDATE causes SET description='$content' WHERE (id='$postcauseid')");
		header('location:/cause/'.$cslug.'/');
	} else {
		header('location:/cause/'.$cslug.'/');
	}
	exit;
?>