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
	<link rel="stylesheet" href="/css/style.css">

	<link rel="stylesheet" href="/plugins/alertify/alertify.core.css" />
	<link rel="stylesheet" href="/plugins/alertify/alertify.default.css" />

	<link rel="stylesheet" href="/plugins/nprogress/nprogress.css" />
</head>
<body class="index">
	<header>
		<a href="/getmps.php"><button class="searchbtn">Search InfoHub</button></a>
		<h1><a href="/">CauseHub.</a></h1>
		<?php
			if($loggedin){
				echo '<span class="loggedin">Welcome back, <a href="/dash">'.getCurrentUserInfo('fname').' '.getCurrentUserInfo('lname').'</a> | <a href="/scripts/logout.php" class="logout">Logout</a></span>';
			} else {
				echo '<span class="login"><a href="/login"><button>Login</button></a><a href="/signup"><button>Signup</button></a></span>';
			}
		?>
	</header>
	<main>
		<form method='post' action='#' onsubmit="return false;" class="causeInit">
			<input type='text' id='causename' placeholder='What&#39;s Your Cause?' class="causeName" onkeyup="updateSuggestions();">
			<input type='submit' id='causecreatebtn' value='Go' onclick='createcause(); return false;'>
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
						  <img src="http://placehold.it/200x100" alt="'.$array['name'].'">
						  <figcaption>'.$array['name'].'</figcaption>
						</figure>
						</a>
						';
					}
				?>
			</section>
	</main>
</body>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script><script src="/scripts/extra.js"></script>
	<script src="/scripts/create.js"></script>
	<script src="/plugins/alertify/alertify.js"></script>
	<script src="/plugins/nprogress/nprogress.js"></script>
</html>
