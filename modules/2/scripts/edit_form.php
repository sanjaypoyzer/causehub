<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/modules/module_functions.php');
	
	if(!checkSession()){
		returnMessage("You need to be logged in to edit this cause","error");
	}

	$mtypeid = $_POST['mtypeid'];

	////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
	////////////////// Add your module code below this point \\\\\\\\\\\\\\\\\\
	////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

	$hashtag = $_POST['mod_twitterfeed_hashtag'];
	$causeid = $_POST['mod_twitterfeed_causeid'];

	if($hashtag==''){
		returnMessage("Please enter a hashtag","error");
	} else if(substr($hashtag, 0, 1)!='#'){
		returnMessage("The please enter a # before your hashtag text","error");
	}

	if(insertIntoActionBase($causeid,$mtypeid)){
		returnMessage("Twitter feed saved successfully","success");
	} else {
		returnMessage("Error attempting to save module","error");
	}
?>