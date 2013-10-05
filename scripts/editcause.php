<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	
	if(!checkSession()){
		echo '3:You need to be logged in to edit this cause:Update';
		exit;
	}

	$postcauseid = $_POST['causeid'];
	$postaction = $_POST['action'];
	$userid = getCurrentUserInfo('id');

	$sql = mysql_query("SELECT id,uid,name,slug,description FROM causes WHERE id='$postcauseid'");
	$logincheck = mysql_num_rows($sql);
	
	$row = mysql_fetch_array($sql);
	$causeid = $row['id'];
	$ownerid = $row['uid'];
	$causename = $row['name'];
	$causedescription = $row['description'];
	$causestart = $row['started'];

	if($userid != $ownerid){
		echo '3:You cannot edit this cause:Update';
		exit;
	}


	if($postaction=='editslug'){
		$requestedslug = $_POST['newslug'];
		$slugsql = mysql_query("SELECT id FROM causes WHERE slug='$requestedslug' AND deleted='0'");
		$slugcheck = mysql_num_rows($slugsql);
		$rowslug = mysql_fetch_array($slugsql);
		$clashid = $rowslug['id'];

		if($slugcheck!=0 && $clashid != $postcauseid){
			echo '3:The slug you entered is already in use:Update';
			exit;
		}

		mysql_query("UPDATE causes SET slug='$requestedslug' WHERE (id='$postcauseid')");

		echo '1:'.$requestedslug.':Redirecting';
		exit;
	}
?>