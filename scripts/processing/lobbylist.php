<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');

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

	echo '<button style="margin-bottom: 5px; width: 100%;">David Cameron <span style="float: right;">&#43;</span></button><br>';
	$sql = mysql_query("SELECT * FROM mp WHERE first_name!='' AND last_name!='' ORDER BY RAND() LIMIT 4");
	while($array = mysql_fetch_array($sql)){
		echo '<button style="margin-bottom: 5px; width: 100%;">'.$array['first_name'].' '.$array['last_name'].' <span style="float: right;">&#43;</span></button><br>';
	}

?>