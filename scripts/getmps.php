<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	
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

	$keyword = mysql_real_escape_string($keyword);
    #$sql = "SELECT DISTINCT mp.mp_id,mp.first_name,mp.last_name FROM mp WHERE mp.mp_id IN (SELECT DISTINCT distance.mp_id from distance WHERE distance.dream_id IN (SELECT dream_id from policy WHERE UPPER(policy.title) LIKE UPPER('%".$keyword."%')) ORDER BY distance.distance)";
    $sql = "SELECT DISTINCT mp.mp_id,mp.first_name,mp.last_name FROM mp LIMIT 5";
	$results = mysql_query($sql);
    if (!$results) {
        echo "Invalid query: ".mysql_error();
    }
    echo "<ul>";
    while ($row = mysql_fetch_array($results)) {
        echo "<li>".$row['first_name']." ".$row['last_name']."</li>\n";
    }
    echo "</ul>";
	exit;
?>
