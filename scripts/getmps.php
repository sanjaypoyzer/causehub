<?php
	session_start();
	$dbpath = ($_SERVER['DOCUMENT_ROOT'].'/mps.db');
    echo $dbpath;
    echo "\nDatabase: ";
    $db = new SQLiteDatabase('filename');
	
	if(!checkSession()){
		echo '3:You need to be logged in the create a cause:Create';
		exit;
	}

	$keyword = $_POST['keyword'];
	$keyword = $_GET['keyword'];
	$userid = getCurrentUserInfo('id');

	if($keyword==''){
		echo 'Missing keyword';
		exit;
	}

	$date = date("d-m-Y");
	$slug = rand(10000,99999);

    echo "blah";

	$keyword = mysql_real_escape_string($keyword);
    #$sql = "SELECT DISTINCT mp.mp_id,mp.first_name,mp.last_name FROM mp WHERE mp.mp_id IN (SELECT DISTINCT distance.mp_id from distance WHERE distance.dream_id IN (SELECT dream_id from policy WHERE UPPER(policy.title) LIKE UPPER('%".$keyword."%')) ORDER BY distance.distance LIMIT 10)";
    $sql = "SELECT DISTINCT mp.mp_id,mp.first_name,mp.last_name FROM mp WHERE mp.mp_id IN (SELECT DISTINCT distance.mp_id from distance WHERE distance.dream_id IN (SELECT dream_id from policy WHERE UPPER(policy.title) LIKE UPPER('%".$keyword."%')) ORDER BY distance.distance LIMIT 10)";
	$results = mysql_query($sql);
    if (!$result) {
        echo "Invalid query: ".mysql_error();
    }
    echo $results;
    echo "blah";
	exit;
?>
