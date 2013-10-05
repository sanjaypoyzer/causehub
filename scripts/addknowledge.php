<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	
	if(!checkSession()){
		echo '3:You need to be logged in to edit this cause:Update';
		exit;
	}

	$postcauseid = $_POST['cid'];
	$userid = getCurrentUserInfo('id');

	$sql = mysql_query("SELECT id,uid,name,slug,description FROM causes WHERE id='$postcauseid'");
	$logincheck = mysql_num_rows($sql);
	
	$row = mysql_fetch_array($sql);
	$causeid = $row['id'];
	$ownerid = $row['uid'];
	$causename = $row['name'];
	$causedescription = $row['description'];
	$causestart = $row['started'];
	$causeslug = $row['slug'];

	if($userid != $ownerid){
		echo '3:You cannot add knowledge to this cause:Add';
		exit;
	}

	$postfact = $_POST['fact'];
	$postsourceurl = $_POST['sourceurl'];
	$postactiontype = $_POST['actiontype'];
	$postlobbylordname = $_POST['lobbylordname'];
	$postlobbylordaddress = $_POST['lobbylordaddress'];
	$postlobbylordmessage = $_POST['lobbylordmessage'];

	if($postfact==''){
		echo '3:No fact entered:Add';
		exit;
	}
	if($postsourceurl==''){
		echo '3:No source url entered:Add';
		exit;
	}
	if($postlobbylordname==''){
		echo '3:No lobby lord name entered:Add';
		exit;
	}
	if($postlobbylordaddress==''){
		echo '3:No lobby lord email address entered:Add';
		exit;
	}
	if($postlobbylordmessage==''){
		echo '3:No lobby lord message entered:Add';
		exit;
	}


	$posttask = mysql_real_escape_string($posttask);
	$postsourceurl = mysql_real_escape_string($postsourceurl);
	$postactiontype = mysql_real_escape_string($postactiontype);
	$postlobbylordname = mysql_real_escape_string($postlobbylordname);
	$postlobbylordaddress = mysql_real_escape_string($postlobbylordaddress);
	$postlobbylordmessage = mysql_real_escape_string($postlobbylordmessage);

	$sourcetitle = 'News';

	mysql_query("INSERT INTO knowledgebase (cid,fact,source,sourcetitle,discussionid,action,actionid,deleted) VALUES('$causeid','$postfact','$postsourceurl','$sourcetitle','1','$postactiontype','1','0') ");

	echo '1:'.$causeslug.':Adding';
	exit;
?>