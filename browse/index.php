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
	<header>
		<h1><a href="/">CauseHub.</a></h1>
		<?php
		if($loggedin){
			echo '<span class="loggedin">Welcome back, <a href="/dash">'.getCurrentUserInfo('fname').' '.getCurrentUserInfo('lname').'</a> | <a href="/scripts/logout.php" class="logout">Logout</a></span>';
		} else {
			echo '<span class="login"><a href="/login"><button>Login</button></a><a href="/Register"><button>Register</button></a></span>';
		}
	?>
	</header>
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
</body>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script><script src="/scripts/extra.js"></script>
	<script src="/plugins/alertify/alertify.js"></script>
	<script src="/plugins/nprogress/nprogress.js"></script>
</html>
