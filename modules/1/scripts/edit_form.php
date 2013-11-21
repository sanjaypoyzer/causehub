<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/modules/module_functions.php');
	
	if(!checkSession()){
		returnMessage("You need to be logged in to edit this cause","error");
	}

	if($_POST['mod_input1']=='yolo'){
		returnMessage("Test","success");
	}

	echo 'error:';
	print_r($_POST);
?>