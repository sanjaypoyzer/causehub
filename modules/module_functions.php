<?php
	function returnMessage($message,$type) {
		if($type=='' || $message==''){return 'Please provide all variables for function to work';}
		echo $type.':'.$message;
		exit;
	}
	
	function getCauseInfo($type,$id) {
		if($type=='' || $id==''){return 'Please provide all variables for function to work';}
	    $result = mysql_query("SELECT " . $type . " FROM causes WHERE id='$id'");
	    $row = mysql_fetch_row($result);
	    return $row[0];
	}
?>