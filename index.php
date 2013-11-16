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
	<title>CauseHub.</title>
	<meta name="description" content="A decentralised, open-source toolkit to bring people around a common cause.">
	<meta name="keywords" content="CauseHub,Cause,Hub,Community,Common,Tool,Toolkit,Decentralised,Open-Source,World">
	<meta name="author" content="CauseHub">

	<link rel="stylesheet" href="/css/style.css">

	<link rel="stylesheet" href="/plugins/alertify/alertify.core.css" />
	<link rel="stylesheet" href="/plugins/alertify/alertify.default.css" />

	<link rel="stylesheet" href="/plugins/nprogress/nprogress.css" />
</head>
<body class="index">
	<?php include ($_SERVER['DOCUMENT_ROOT'].'/scripts/header-include.php'); ?>
	<main>
		<form method='post' action='#' onsubmit="return false;" class="causeInit">
			<input type='text' id='causename' placeholder='What&#39;s Your Cause?' class="causeName" onkeyup="updateSuggestions();">
			
		</form>
			<section class="causeThumbs" id='relatedlist' style='display: none;'>
				<h2>Related Causes</h2>
				<div id='response'></div>
			</section>
			<section class="causeThumbs" id='featuredlist'>
				<h2>Latest Causes</h2>
				<?php
				$sql = mysql_query("SELECT * FROM causes WHERE deleted='0' AND hidden='0' ORDER BY id DESC LIMIT 3");
					while($array = mysql_fetch_array($sql)){
						echo '
						<a href="/cause/'.$array['slug'].'/">
						<figure>
						  <div style="width: 200px; height: 100px; background: url(/usercontent/causebanners/'.$array['banner'].') no-repeat center center; background-size: cover;"></div>
						  <figcaption>'.$array['name'].'</figcaption>
						</figure>
						</a>
						';
					}
				?>
			</section>
			<input type='submit' id='causecreatebtn' value='Create Cause' onclick='createcause(); return false;'>
	</main>
	<?php include ($_SERVER['DOCUMENT_ROOT'].'/scripts/feedback-include.php'); ?>
</body>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script><script src="/scripts/extra.js"></script>
	<script src="/scripts/create.js"></script>
	<script src="/plugins/alertify/alertify.js"></script>
	<script src="/plugins/nprogress/nprogress.js"></script>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-45734252-1', 'causehub.co');
	  ga('send', 'pageview');
	</script>
		<?php
		if($_SESSION['delete_msg']!=''){
			$parts = explode(':', $_SESSION['delete_msg']);
			echo '<script>';
			echo 'alertify.log("'.$parts[1].'","'.$parts[0].'");';
			echo '</script>';
			unset($_SESSION['delete_msg']);
		}
	?>
</html>
