<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	
	if(!checkSession()){
		echo '2:You need to be logged in to edit this cause:Update';
		exit;
	}

	$postcauseid = $_POST['cid'];
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
		echo '2:You cannot add knowledge to this cause:Add';
		exit;
	}

	$postactiontype = mysql_real_escape_string($_POST['actiontype']);
	$postactiontext = mysql_real_escape_string($_POST['actiontext']);
	$postactionlink = mysql_real_escape_string($_POST['actionlink']);
	if($postactiontype==''){
		echo '2:No action type selected:Add';
		exit;
	}
	if($postactiontext==''){
		echo '2:No action text added:Add';
		exit;
	}
	if($postactionlink==''){
		echo '2:No action link added:Add';
		exit;
	}

	if($postactiontype=='petition'){
		mysql_query("INSERT INTO action_petition (atext,link) VALUES('$postactiontext','$postactionlink') ");
		$sql = mysql_query("SELECT id FROM action_petition WHERE atext='$postactiontext' AND link='$postactionlink' ORDER BY id DESC LIMIT 1");
		$row = mysql_fetch_array($sql);
		$actionid = $row['id'];
	} else if($postactiontype=='event'){
		mysql_query("INSERT INTO action_event (atext,link) VALUES('$postactiontext','$postactionlink') ");
		$sql = mysql_query("SELECT id FROM action_event WHERE atext='$postactiontext' AND link='$postactionlink' ORDER BY id DESC LIMIT 1");
		$row = mysql_fetch_array($sql);
		$actionid = $row['id'];
	} else if($postactiontype=='other'){
		mysql_query("INSERT INTO action_other (atext,link) VALUES('$postactiontext','$postactionlink') ");
		$sql = mysql_query("SELECT id FROM action_other WHERE atext='$postactiontext' AND link='$postactionlink' ORDER BY id DESC LIMIT 1");
		$row = mysql_fetch_array($sql);
		$actionid = $row['id'];
	}

	$timedate = date("H:i:s d-m-Y");

	mysql_query("INSERT INTO actionbase (cid,action,actionid,timedate,deleted) VALUES('$causeid','$postactiontype','$actionid','$timedate','0') ");

	echo '1:Done:Adding';
	exit;
?>