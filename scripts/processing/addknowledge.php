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

	if($userid != $ownerid){
		echo '2:You cannot add knowledge to this cause:Add';
		exit;
	}

	$postfact = $_POST['fact'];
	$postsourceurl = $_POST['sourceurl'];
	$postactiontype = $_POST['actiontype'];
	if($postfact==''){
		echo '2:No fact entered:Add';
		exit;
	}
	if($postsourceurl==''){
		echo '2:No source url entered:Add';
		exit;
	}

	if($postactiontype=='lobbyLord'){
		$postlobbylordname = $_POST['lobbylordname'];
		$postlobbylordaddress = $_POST['lobbylordaddress'];
		$postlobbylordmessage = $_POST['lobbylordmessage'];

		if($postlobbylordname==''){
			echo '2:No lobby lord name entered:Add';
			exit;
		}
		if($postlobbylordaddress==''){
			echo '2:No lobby lord email address entered:Add';
			exit;
		}
		if($postlobbylordmessage==''){
			echo '2:No lobby lord message entered:Add';
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
			echo '2:No lobby MP name entered:Add';
			exit;
		}
		if($postlobbympaddress==''){
			echo '2:No lobby MP email address entered:Add';
			exit;
		}
		if($postlobbympmessage==''){
			echo '2:No lobby MP message entered:Add';
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
			echo '2:No lobby Media name entered:Add';
			exit;
		}
		if($postlobbymediaaddress==''){
			echo '2:No lobby Media email address entered:Add';
			exit;
		}
		if($postlobbymediamessage==''){
			echo '2:No lobby Media message entered:Add';
			exit;
		}

		$postlobbymedianame = mysql_real_escape_string($postlobbymedianame);
		$postlobbymediaaddress = mysql_real_escape_string($postlobbymediaaddress);
		$postlobbymediamessage = mysql_real_escape_string($postlobbymediamessage);

		mysql_query("INSERT INTO kb_action_lobbymedia (name,address,message) VALUES('$postlobbymedianame','$postlobbymediaaddress','$postlobbymediamessage') ");
		$sql = mysql_query("SELECT id FROM kb_action_lobbymedia WHERE name='$postlobbymedianame' AND address='$postlobbymediaaddress' AND message='$postlobbymediamessage' ORDER BY id DESC LIMIT 1");
		$row = mysql_fetch_array($sql);
		$actionid = $row['id'];
	} else if($postactiontype=='createPetition'){
		$postpetitionname = $_POST['petitionname'];
		$postpetitiondescription = $_POST['petitiondescription'];

		if($postpetitionname==''){
			echo '2:No petition name entered:Add';
			exit;
		}
		if($postpetitiondescription==''){
			echo '2:No petition description entered:Add';
			exit;
		}

		$postpetitionname = mysql_real_escape_string($postpetitionname);
		$postpetitiondescription = mysql_real_escape_string($postpetitiondescription);
		$petitionslug = rand(10000,99999);

		mysql_query("INSERT INTO kb_action_petitions (name,description,slug) VALUES('$postpetitionname','$postpetitiondescription','$petitionslug') ");
		$sql = mysql_query("SELECT id FROM kb_action_petitions WHERE name='$postpetitionname' AND description='$postpetitiondescription' AND slug='$petitionslug' ORDER BY id DESC LIMIT 1");
		$row = mysql_fetch_array($sql);
		$actionid = $row['id'];
	} else if($postactiontype=='hostEvent'){
		$posteventname = $_POST['eventname'];
		$posteventurl = $_POST['eventurl'];

		if($posteventname==''){
			echo '2:No event name entered:Add';
			exit;
		}
		if($posteventurl==''){
			echo '2:No event url entered:Add';
			exit;
		}

		$posteventname = mysql_real_escape_string($posteventname);
		$posteventurl = mysql_real_escape_string($posteventurl);

		mysql_query("INSERT INTO kb_action_hostevent (name,url) VALUES('$posteventname','$posteventurl') ");
		$sql = mysql_query("SELECT id FROM kb_action_hostevent WHERE name='$posteventname' AND url='$posteventurl' ORDER BY id DESC LIMIT 1");
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