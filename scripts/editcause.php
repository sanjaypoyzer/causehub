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
	$cslug = $row['slug'];

	if($userid != $ownerid){
		echo '3:You cannot edit this cause:Update';
		exit;
	}


	if($postaction=='editslug'){
		$requestedslug = $_POST['newslug'];
		$requestedslug = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $requestedslug)));
		$sqlslug = mysql_real_escape_string($requestedslug);
		$slugsql = mysql_query("SELECT id FROM causes WHERE slug='$sqlslug' AND deleted='0'");
		$slugcheck = mysql_num_rows($slugsql);
		$rowslug = mysql_fetch_array($slugsql);
		$clashid = $rowslug['id'];

		if($slugcheck!=0 && $clashid != $postcauseid){
			echo '3:The slug you entered is already in use:Update';
			exit;
		}

		mysql_query("UPDATE causes SET slug='$sqlslug' WHERE (id='$postcauseid')");

		echo '1:'.$requestedslug.':Redirecting';
		exit;
	} else if($postaction=='editdescription'){
		$requesteddescription = $_POST['newdescription'];
		
		if(strlen($requesteddescription)<100){
			echo '3:Please enter at least 100 characters in the decription:Update';
			exit;
		}

		$sqldescription = mysql_real_escape_string($requesteddescription);
		mysql_query("UPDATE causes SET description='$sqldescription' WHERE (id='$postcauseid')");

		echo '1:Description successfully updated:Update';
		exit;
	} else if($postaction=='publish'){
		$cid = $_POST['causeid'];
		
		if(strlen($causedescription)<100){
			echo '2:You cannot publish your cause until you have a description over 100 characters long:Start changing the world!';
			exit;
		}

		mysql_query("UPDATE causes SET hidden='0' WHERE (id='$cid')");

		echo '1:'.$cslug.':Redirecting';
		exit;
	}
?>