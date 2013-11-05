<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');

	if(checkSession()){$loggedin = true;} else {$loggedin = false;}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>CauseHub. | Browse Causes</title>
	<link rel="stylesheet" href="/css/style.css">

	<link rel="stylesheet" href="/plugins/alertify/alertify.core.css" />
	<link rel="stylesheet" href="/plugins/alertify/alertify.default.css" />

	<link rel="stylesheet" href="/plugins/nprogress/nprogress.css" />
</head>
<body>
	<?php include ($_SERVER['DOCUMENT_ROOT'].'/scripts/header-include.php'); ?>
	<main class="dash">
		<h1>All Causes</h1>
		<section class="causeThumbs">
		<?php
		$sql = mysql_query("SELECT * FROM causes WHERE hidden='0' AND deleted='0' ORDER BY id DESC LIMIT 15");
			while($array = mysql_fetch_array($sql)){
				echo '
				<a href="/cause/'.$array['slug'].'/">
				<figure>
				  <img src="/images/200x100_placeholder.gif" alt="'.$array['name'].'">
				  <figcaption>'.$array['name'].'</figcaption><br><a href="/editcause/'.$array['slug'].'/" class="dashmanage">Manage this</a>
				</figure>
				</a>
				';
			}
		?>
	</section>
	</main>
	<?php include ($_SERVER['DOCUMENT_ROOT'].'/scripts/feedback-include.php'); ?>
</body>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script><script src="/scripts/extra.js"></script>
	<script src="/plugins/alertify/alertify.js"></script>
	<script src="/plugins/nprogress/nprogress.js"></script>
</html>
