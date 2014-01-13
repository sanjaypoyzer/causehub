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
	$sql = "SELECT d.mp_id from distance d WHERE d.distance < 0.2 AND exists (select 1 from policy p where UPPER(p.title) LIKE UPPER('%".$keyword."%') and p.dream_id = d.dream_id) ORDER BY d.distance LIMIT 5;";
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
