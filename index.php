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
	<input type='text' id='causename' placeholder='What&#39;s Your Cause?' class="causeName">
	<input type='submit' id='causecreatebtn' value='Go' onclick='createcause(); return false;'>
	</form>
	<section class="causeThumbs">
		<h2>Featured Causes</h2>
		<?php
		$sql = mysql_query("SELECT * FROM causes WHERE deleted='0' ORDER BY id DESC LIMIT 3");
			$start = 100;
			while($array = mysql_fetch_array($sql)){
				echo '
				<a href="/cause/'.$array['slug'].'/">
				<figure>
				  <img src="http://lorempixel.com/200/'.$start.'" alt="'.$array['name'].'">
				  <figcaption>'.$array['name'].'</figcaption>
				</figure>
				</a>
				';
				$start++;
			}
		?>
	</section>
</main>

</body>
</html>
