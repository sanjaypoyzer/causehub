<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');

	if(!checkSession()){header('location:/login');}
	if(checkSession()){$loggedin = true;} else {$loggedin = false;}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>CauseHub. | Dashboard</title>
	<meta name="description" content="A decentralised, open-source toolkit to bring people around a common cause.">
	<meta name="keywords" content="CauseHub,Cause,Hub,Community,Common,Tool,Toolkit,Decentralised,Open-Source,World">
	<meta name="author" content="CauseHub">

	<link rel="stylesheet" href="/css/style.css">

	<link rel="stylesheet" href="/plugins/alertify/alertify.core.css" />
	<link rel="stylesheet" href="/plugins/alertify/alertify.default.css" />

	<link rel="stylesheet" href="/plugins/nprogress/nprogress.css" />
</head>
<body>
	<?php include ($_SERVER['DOCUMENT_ROOT'].'/scripts/header-include.php'); ?>
	<main class="dash">
		<h1>Your Causes</h1>
		<section class="causeThumbs">
		<?php
		$userid = getCurrentUserInfo('id');
		$sql = mysql_query("SELECT * FROM causes WHERE uid='$userid' AND deleted='0' ORDER BY id DESC");
			while($array = mysql_fetch_array($sql)){
				echo '
				<a href="/cause/'.$array['slug'].'/">
				<figure>
				  <div style="width: 200px; height: 100px; background: url(/usercontent/causebanners/'.$array['banner'].') no-repeat center center; background-size: cover;"></div>
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
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-45734252-1', 'causehub.co');
	  ga('send', 'pageview');
	</script>
</html>
