<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	
	if(!checkSession()){
		echo '3:You need to be logged in to edit this cause:Update';
		exit;
	}

	$postcauseid = $_GET['cid'];
	$postcontent = $_POST['content'];
	$userid = getCurrentUserInfo('id');

	$sql = mysql_query("SELECT id,uid,name,slug,description FROM causes WHERE id='$postcauseid'");
	$logincheck = mysql_num_rows($sql);
	
	$row = mysql_fetch_array($sql);
	$causeid = $row['id'];
	$ownerid = $row['uid'];
	$causename = $row['name'];
	$causedescription = $row['description'];
	$causestart = $row['started'];
	$cslug = $row['slug'];

	if($userid != $ownerid){
		echo '3:You cannot edit this cause:Update';
		exit;
	}
	if($postcontent!=''){
		$content = mysql_real_escape_string($postcontent);
		mysql_query("UPDATE causes SET description='$content' WHERE (id='$postcauseid')");
		echo '1:Decription saved:Update';
	} else {
		echo '2:No description entered:Update';
	}
	exit;
?>