<?php
function curPageURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

$noslashcheck = $_GET['noslashcheck'];
if($noslashcheck==''){
	$url = curPageURL();
	$lastchar = substr($url, -1);
	if($lastchar!='/'){
		header('location:'.$url.'/');
	}
}
?>
404 error