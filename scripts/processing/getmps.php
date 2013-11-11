<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');

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
    #$sql = "SELECT DISTINCT mp.mp_id,mp.first_name,mp.last_name FROM mp WHERE mp.mp_id IN (SELECT DISTINCT distance.mp_id from distance WHERE distance.distance < 0.2 AND distance.dream_id IN (SELECT dream_id from policy WHERE UPPER(policy.title) LIKE UPPER('%".$keyword."%')) ORDER BY distance.distance)";
    $sql = "SELECT DISTINCT distance.mp_id from distance WHERE distance.distance < 0.2 AND distance.dream_id IN (SELECT dream_id from policy WHERE UPPER(policy.title) LIKE UPPER('%".$keyword."%')) ORDER BY distance.distance LIMIT 5";
    #$sql = "SELECT DISTINCT mp.mp_id,mp.first_name,mp.last_name FROM mp LIMIT 5";
	$results = mysql_query($sql);
    if (!$results) {
        echo "Invalid query: ".mysql_error();
    }
    echo "<ul>";
    while ($row = mysql_fetch_array($results)) {
        $mpid = $row['mp_id'];
        $sql = "SELECT mp.first_name,mp.last_name FROM mp WHERE mp_id = ".$mpid;
        $result = mysql_query($sql);
        if (!$result) {
            echo "Invalid query: ".mysql_error();
        }
        $result = mysql_fetch_assoc($result);
        echo "<li>".$result['first_name']." ".$result['last_name']."</li>\n";
    }
    echo "</ul>";
	exit;
?>
