<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');

	$postcauseid = $_GET['cid'];
	$addlobbyid = $_GET['lid'];
	$userid = getCurrentUserInfo('id');

	$sql = mysql_query("SELECT id,uid,name,slug,description,lobbys FROM causes WHERE id='$postcauseid'");
	
	$row = mysql_fetch_array($sql);
	$causeid = $row['id'];
	$ownerid = $row['uid'];
	$causename = $row['name'];
	$causedescription = $row['description'];
	$causelobbys = $row['lobbys'];
	$causestart = $row['started'];
	$causeslug = $row['slug'];

	if($causeid=='' || $addlobbyid==''){
		header('location:/');
	}
	
	$exp = explode(':', $causelobbys);
	$i = 0;
	$removed = false;
	while($i<count($exp)){
		if($exp[$i]==$addlobbyid){
			unset($exp[$i]);
			$removed = true;
		}
		$i++;
	}
	$exp = array_values($exp);

	if(!$removed){
		$exp[count($exp)] = $addlobbyid;
	}
	
	$expfix = '';
	$i = 0;
	while($i<count($exp)){
		$expfix .= $exp[$i].':';
		$i++;
	}
	
	$expfix = substr($expfix,0,-1);

	if($causelobbys==''){
		$expfix = $addlobbyid;
	}

	mysql_query("UPDATE causes SET lobbys='$expfix' WHERE (id='$causeid')");

	header('location:/editcause/'.$causeslug);
?>