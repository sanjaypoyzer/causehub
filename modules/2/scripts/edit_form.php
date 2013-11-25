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

	//Getting your post variabled from the edit form, (these are the inputs defined in edit_form.json)
	$hashtag = $_POST['mod_twitterfeed_hashtag'];

	//Just some defensive code that is only nessesary to this certain module
	if($hashtag==''){
		//Using the returnMessage function to return an error message, this also stops the running of the code
		returnMessage("Please enter a hashtag","error");
	} else if(substr($hashtag, 0, 1)!='#'){
		//Using the returnMessage function to return an error message, this also stops the running of the code
		returnMessage("The please enter a # before your hashtag text","error");
	}
	$hashtag = mysql_real_escape_string($hashtag);

	//Inseting data in table for the module
	mysql_query("INSERT INTO mod_twitterfeed (hashtag) VALUES('$hashtag') ");
	//Getting the id of the row that has just been created, so it can be added to the main action base table row
	$sql = mysql_query("SELECT id FROM mod_twitterfeed WHERE hashtag='$hashtag' ORDER BY id DESC LIMIT 1");
	$row = mysql_fetch_array($sql);
	$mdbid = $row['id'];

	//Saving the module into the main action base table
	if(insertIntoActionBase($causeid,$mtypeid,$mdbid)){
		//Using the returnMessage function to return a success message, this also stops the running of the code
		returnMessage("Twitter feed saved successfully","success");
	} else {
		//Using the returnMessage function to return an error message, this also stops the running of the code
		returnMessage("Error attempting to save module","error");
	}
?>