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
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="/scripts/create.js"></script>
  <script src="/plugins/alertify/alertify.js"></script>
  <link rel="stylesheet" href="/plugins/alertify/alertify.core.css" />
  <link rel="stylesheet" href="/plugins/alertify/alertify.default.css" />
</head>
<body class="index">
<header>
	<h1>CauseHub.</h1>
	<?php
		if($loggedin){
			echo '<span class="loggedin">Welcome back, '.getCurrentUserInfo('fname').' '.getCurrentUserInfo('lname').'</span>';
		} else {
			echo '<span class="login"><a href="/login"><button>Login</button></a><a href="/signup"><button>Signup</button></a></span>';
		}
	?>
</header>
<main>
	<form method='post' action='#' onsubmit="return false;" class="causeInit">
	<input type='text' id='causename' placeholder='What&#39;s Your Cause?' class="causeName">
	<input type='submit' id='causecreatebtn' value='Go' onclick='createcause(); return false;'>
	</form>
</main>

</body>
</html>
