<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	
	if(!checkSession()){
		echo '2:You need to be logged in to edit this cause:Update';
		exit;
	}

	$postcauseid = $_POST['causeid'];
	$postaction = $_POST['action'];
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

	if($userid != $ownerid){
		echo '2:You do not have access to make changes to the requested cause:Update';
		exit;
	}


	if($postaction=='deletecause'){
		mysql_query("UPDATE causes SET deleted='1',hidden='1' WHERE (id='$postcauseid')");
		$_SESSION['delete_msg'] = 'success:'.$causename.' has been deleted successfully';
		echo '1';
		exit;
	} else if($postaction=='editslug'){
		$requestedslug = $_POST['newslug'];
		$requestedslug = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $requestedslug)));
		$sqlslug = mysql_real_escape_string($requestedslug);
		$slugsql = mysql_query("SELECT id FROM causes WHERE slug='$sqlslug' AND deleted='0'");
		$slugcheck = mysql_num_rows($slugsql);
		$rowslug = mysql_fetch_array($slugsql);
		$clashid = $rowslug['id'];

		if($slugcheck!=0 && $clashid != $postcauseid){
			echo '2:The slug you entered is already in use:Update';
			exit;
		}

		mysql_query("UPDATE causes SET slug='$sqlslug' WHERE (id='$postcauseid')");

		echo '1:'.$requestedslug.':Redirecting';
		exit;
	} else if($postaction=='edittags'){
		$causetags = $_POST['newtags'];

		mysql_query("UPDATE causes SET tags='$causetags' WHERE (id='$postcauseid')");

		echo '1:Updated cause tags';
		exit;
	} else if($postaction=='publish'){
		$cid = $_POST['causeid'];
		$defaultdesc = mysql_real_escape_string(file_get_contents('default_desc.json'));
		$causedescription = mysql_real_escape_string($causedescription);

		$totaltags = explode(',', $causetags);

		if($causedescription==$defaultdesc || count($totaltags)<2){
			echo '2:To publish your cause, please add some description about it and at least two tags:Start changing the world!';
			exit;
		}

		mysql_query("UPDATE causes SET hidden='0' WHERE (id='$cid')");

		echo '1:'.$cslug.':Redirecting';
		exit;
	}
?>