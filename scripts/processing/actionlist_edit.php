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
		echo '2:You cannot edit action points:Add';
		exit;
	}

	echo '<ul>';

	$total = 0;
	$sql = mysql_query("SELECT * FROM actionbase WHERE cid='$causeid' AND deleted='0' ORDER BY id DESC");
	while($array = mysql_fetch_array($sql)){
		if($array['action']=='petition'){
			$actionid = $array['actionid'];
			$sqldata = mysql_query("SELECT * FROM action_petition WHERE id='$actionid'");
			$row = mysql_fetch_array($sqldata);
			echo '<li>'.$row['atext'].' &rarr; <a href="'.$row['link'].'" target=_blank>Sign it!</a></li>';
		} else if($array['action']=='event'){
			$actionid = $array['actionid'];
			$sqldata = mysql_query("SELECT * FROM action_event WHERE id='$actionid'");
			$row = mysql_fetch_array($sqldata);
			echo '<li>'.$row['atext'].' &rarr; <a href="'.$row['link'].'" target=_blank>Join it!</a></li>';
		} else if($array['action']=='other'){
			$actionid = $array['actionid'];
			$sqldata = mysql_query("SELECT * FROM action_other WHERE id='$actionid'");
			$row = mysql_fetch_array($sqldata);
			echo '<li>'.$row['atext'].' &rarr; <a href="'.$row['link'].'" target=_blank>Join it!</a></li>';
		}
		$total++;
	}

	if($total==0){
		echo '<li>No entries added to the action base</li>';
	}


	echo '</ul>';
?>