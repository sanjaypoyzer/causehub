<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');

	if(checkSession()){$loggedin = true;} else {$loggedin = false;}

	$slug = $_GET['slug'];
	$sql = mysql_query("SELECT id,name,description FROM kb_action_petitions WHERE slug='$slug'");
	$logincheck = mysql_num_rows($sql);
	$pagefound = false;
	if($logincheck!=0){
		$pagefound = true;
	}
	
	$row = mysql_fetch_array($sql);
	$petitionid = $row['id'];
	$petitionname = $row['name'];
	$petitiondescription = $row['description'];


	if(!$pagefound){
		echo 'Cause not found';
		exit;
	}
?>