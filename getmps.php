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
		<h1><a href="/">CauseHub.</a></h1>
		<?php
			if($loggedin){
				echo '<span class="loggedin">Welcome back, <a href="/dash">'.getCurrentUserInfo('fname').' '.getCurrentUserInfo('lname').'</a> | <a href="/scripts/logout.php" class="logout">Logout</a></span>';
			} else {
				echo '<span class="login"><a href="/login"><button>Login</button></a><a href="/Register"><button>Register</button></a></span>';
			}
		?>
	</header>
	<main>
		<form method='post' action='#' onsubmit="return false;" class="causeInit">
		<input type='text' id='causename' placeholder='Please enter policy keywords' class="causeName">
		<input type='submit' id='causecreatebtn' value='Go' onclick='getmps(); return false;'>
		</form>
	    <div id="results"/>
	</main>
	<?php include ($_SERVER['DOCUMENT_ROOT'].'/scripts/feedback.php'); ?>
</body>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script><script src="/scripts/extra.js"></script>
	<script src="/scripts/getmps.js"></script>
	<script src="/plugins/alertify/alertify.js"></script>
	<script src="/plugins/nprogress/nprogress.js"></script>
</html>
