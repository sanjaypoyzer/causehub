<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	
	if(!checkSession()){
		echo '3:You need to be logged in the create a cause:Create';
		exit;
	}

	$causename = $_POST['causename'];
	$userid = getCurrentUserInfo('id');

	if($causename==''){
		echo '2:No cause name entered:Create';
		exit;
	}

	if(preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $causename)))==''){
		echo '2:You cause contains invalid characters:Create';
		exit;
	}

	$date = date("d-m-Y");

		$slugchosen = false;
		$extra = 1;
		while(!$slugchosen){
			if($extra==1){
				$causenameslug = $causename;
			} else {
				$causenameslug = $causename.'-'.$extra;
			}
			$slug = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $causenameslug)));
			$sqlslug = mysql_real_escape_string($slug);
			$slugsql = mysql_query("SELECT id FROM causes WHERE slug='$sqlslug' AND deleted='0'");
			$slugcheck = mysql_num_rows($slugsql);

			if($slugcheck!=0){
				$extra++;
			} else {
				$slugchosen = true;
			}
		}

	$causename = mysql_real_escape_string($causename);
	$defaultdesc = mysql_real_escape_string(file_get_contents('default_desc.json'));
	mysql_query("INSERT INTO causes (uid,name,slug,started,banner,description,tags,hidden,deleted) VALUES('$userid','$causename','$slug','$date','placehold.gif','$defaultdesc','','1','0') ");

	echo '1:'.$slug.':Redirecting';
	exit;
?>