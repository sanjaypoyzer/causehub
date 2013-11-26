<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/modules/module_functions.php');
	
	if(!checkSession()){
		returnMessage("You need to be logged in to edit this cause","error");
	}

	$mtypeid = $_POST['mtypeid'];
	$causeid = $_POST['causeid'];
	
	////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
	////////////////// Add your module code below this point \\\\\\\\\\\\\\\\\\
	////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

	$code = $_POST['mod_htmlembedder_code'];

	if($code==''){
		returnMessage("Please enter html code to save","error");
	}

	$code = mysql_real_escape_string($code);

	mysql_query("INSERT INTO mod_htmlembedder (htmlcode) VALUES('$code') ");
	
	$sql = mysql_query("SELECT id FROM mod_htmlembedder WHERE htmlcode='$code' ORDER BY id DESC LIMIT 1");
	$row = mysql_fetch_array($sql);
	$mdbid = $row['id'];

	if(insertIntoActionBase($causeid,$mtypeid,$mdbid)){
		returnMessage("HTML embed code saved","success");
	} else {
		returnMessage("Error attempting to save module","error");
	}
?>