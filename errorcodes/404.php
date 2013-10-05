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

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>CauseHub.</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>	
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>CauseHub. | 404 Error</title>
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
</head>
<body class="index">
<header>
	<h1>CauseHub.</h1>
<main>
	<h1 class="animated bounceOutDown">404</h1>
</form>
</main>
</body>
</html>
