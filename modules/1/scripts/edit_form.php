<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/modules/module_functions.php');
	
	if(!checkSession()){
		returnMessage("You need to be logged in to edit this cause","error");
	}

	////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
	////////////////// Add your module code below this point \\\\\\\\\\\\\\\\\\
	////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

	$causeid = $_POST['mod_causeid'];

	if($_POST['blah']=='yolo'){
		returnMessage("Test","success");
	}

	returnMessage(getCauseInfo('name',$causeid)." - ".getOtherUserInfo('fname',2),"info");
?>