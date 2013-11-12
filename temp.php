<?php
	include('scripts/connect.php');
	mysql_query("ALTER TABLE users ADD admin int NOT NULL");
	echo 'done<br>';

	$sql = mysql_query("SELECT username,admin FROM users WHERE id='1'");
	$row = mysql_fetch_row($sql);
	echo $row[0].' '.$row[1];
?>