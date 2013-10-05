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
	if($postfact==''){
		echo '3:No fact entered:Add';
		exit;
	}
	if($postsourceurl==''){
		echo '3:No source url entered:Add';
		exit;
	}

	if($postactiontype=='lobbyLord'){
		$postlobbylordname = $_POST['lobbylordname'];
		$postlobbylordaddress = $_POST['lobbylordaddress'];
		$postlobbylordmessage = $_POST['lobbylordmessage'];

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

		$postlobbylordname = mysql_real_escape_string($postlobbylordname);
		$postlobbylordaddress = mysql_real_escape_string($postlobbylordaddress);
		$postlobbylordmessage = mysql_real_escape_string($postlobbylordmessage);

		mysql_query("INSERT INTO kb_action_lobbylord (name,address,message) VALUES('$postlobbylordname','$postlobbylordaddress','$postlobbylordmessage') ");
		$sql = mysql_query("SELECT id FROM kb_action_lobbylord WHERE name='$postlobbylordname' AND address='$postlobbylordaddress' AND message='$postlobbylordmessage' ORDER BY id DESC LIMIT 1");
		$row = mysql_fetch_array($sql);
		$actionid = $row['id'];
	} else if($postactiontype=='lobbyMP'){
		$postlobbympname = $_POST['lobbympname'];
		$postlobbympaddress = $_POST['lobbympaddress'];
		$postlobbympmessage = $_POST['lobbympmessage'];

		if($postlobbympname==''){
			echo '3:No lobby MP name entered:Add';
			exit;
		}
		if($postlobbympaddress==''){
			echo '3:No lobby MP email address entered:Add';
			exit;
		}
		if($postlobbympmessage==''){
			echo '3:No lobby MP message entered:Add';
			exit;
		}

		$postlobbympname = mysql_real_escape_string($postlobbympname);
		$postlobbympaddress = mysql_real_escape_string($postlobbympaddress);
		$postlobbympmessage = mysql_real_escape_string($postlobbympmessage);

		mysql_query("INSERT INTO kb_action_lobbymp (name,address,message) VALUES('$postlobbympname','$postlobbympaddress','$postlobbympmessage') ");
		$sql = mysql_query("SELECT id FROM kb_action_lobbymp WHERE name='$postlobbympname' AND address='$postlobbympaddress' AND message='$postlobbympmessage' ORDER BY id DESC LIMIT 1");
		$row = mysql_fetch_array($sql);
		$actionid = $row['id'];
	} else if($postactiontype=='lobbyMedia'){
		$postlobbymedianame = $_POST['lobbymedianame'];
		$postlobbymediaaddress = $_POST['lobbymediaaddress'];
		$postlobbymediamessage = $_POST['lobbymediamessage'];

		if($postlobbymedianame==''){
			echo '3:No lobby Media name entered:Add';
			exit;
		}
		if($postlobbymediaaddress==''){
			echo '3:No lobby Media email address entered:Add';
			exit;
		}
		if($postlobbymediamessage==''){
			echo '3:No lobby Media message entered:Add';
			exit;
		}

		$postlobbymedianame = mysql_real_escape_string($postlobbymedianame);
		$postlobbymediaaddress = mysql_real_escape_string($postlobbymediaaddress);
		$postlobbymediamessage = mysql_real_escape_string($postlobbymediamessage);

		mysql_query("INSERT INTO kb_action_lobbymedia (name,address,message) VALUES('$postlobbymedianame','$postlobbymediaaddress','$postlobbymediamessage') ");
		$sql = mysql_query("SELECT id FROM kb_action_lobbymedia WHERE name='$postlobbymedianame' AND address='$postlobbymediaaddress' AND message='$postlobbymediamessage' ORDER BY id DESC LIMIT 1");
		$row = mysql_fetch_array($sql);
		$actionid = $row['id'];
	}

	$posttask = mysql_real_escape_string($posttask);
	$postsourceurl = mysql_real_escape_string($postsourceurl);
	$postactiontype = mysql_real_escape_string($postactiontype);
	$sourcetitle = 'News';

	mysql_query("INSERT INTO knowledgebase (cid,fact,source,sourcetitle,discussionid,action,actionid,deleted) VALUES('$causeid','$postfact','$postsourceurl','$sourcetitle','1','$postactiontype','$actionid','0') ");

	echo '1:'.$causeslug.':Adding';
	exit;
?>