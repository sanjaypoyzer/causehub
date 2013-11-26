<?php
	$dbid = $data['moduledbid'];
	$sql = mysql_query("SELECT * FROM mod_htmlembedder WHERE id='$dbid' LIMIT 1");
	$row = mysql_fetch_array($sql);
	echo $row['htmlcode'];
?>