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
	$widgetid = $_POST['mod_twitterfeed_widgetid'];

	//Just some defensive code that is only nessesary to this certain module
	if($widgetid==''){
		//Using the returnMessage function to return an error message, this also stops the running of the code
		returnMessage("Please enter a twitter widget id","error");
	} else if(strlen($widgetid)!=18){
		//Using the returnMessage function to return an error message, this also stops the running of the code
		returnMessage("The widget id you entered is invalid","error");
	}
	$widgetid = mysql_real_escape_string($widgetid);

	//Inseting data in table for the module
	mysql_query("INSERT INTO mod_twitterwidget (widgetid) VALUES('$widgetid') ");
	//Getting the id of the row that has just been created, so it can be added to the main action base table row
	$sql = mysql_query("SELECT id FROM mod_twitterwidget WHERE widgetid='$widgetid' ORDER BY id DESC LIMIT 1");
	$row = mysql_fetch_array($sql);
	$mdbid = $row['id'];

	//Saving the module into the main action base table
	if(insertIntoActionBase($causeid,$mtypeid,$mdbid)){
		//Using the returnMessage function to return a success message, this also stops the running of the code
		returnMessage("Twitter widget saved successfully","success");
	} else {
		//Using the returnMessage function to return an error message, this also stops the running of the code
		returnMessage("Error attempting to save module","error");
	}
?>