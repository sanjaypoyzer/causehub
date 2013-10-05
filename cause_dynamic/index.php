<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');

	if(checkSession()){$loggedin = true;} else {$loggedin = false;}

	$slug = $_GET['slug'];
	$sql = mysql_query("SELECT id,uid,name,slug,description,hidden FROM causes WHERE slug='$slug' AND deleted='0'");
	$logincheck = mysql_num_rows($sql);
	$pagefound = false;
	if($logincheck!=0){
		$pagefound = true;
	}
	
	$row = mysql_fetch_array($sql);
	$causeid = $row['id'];
	$ownerid = $row['uid'];
	$causename = $row['name'];
	$causedescription = $row['description'];
	$causestart = $row['started'];
	$causehidden = $row['hidden'];

	if($ownerid!=getCurrentUserInfo('id')){
		$pagefound = false;
	}

	if(!$pagefound){
		echo 'Cause not found';
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>CauseHub | <?php echo $causename; ?></title>
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="/scripts/editcause.js"></script>

  <script src="/plugins/alertify/alertify.js"></script>
  <link rel="stylesheet" href="/plugins/alertify/alertify.core.css" />
  <link rel="stylesheet" href="/plugins/alertify/alertify.default.css" />
</head>
<body>
<header>
	<h1>CausePage</h1>
	<span class="login"><button>Login</button><button>Signup</button></span>
</header>
	<img src="http://lorempixel.com/1200/200/" class="causeImg" />
<main>
	<section class="causeDescription">
		<h1><?php echo $causename; ?></h1>
		<?php echo $causedescription; ?>
	</section>
	<section class="knowledgeBaseSummary">
		<h1>Knowledge Base Summary</h1>
		<ul>
			<li>Here is a fact &rarr; 
				<a href="#">Act on it!</a>
				<ul>
					<li><a href="#">Source: News</a></li>
					<li><a href="#">Source: Vote Data</a></li>
				</ul>
			</li>
			<li>Here is a fact &rarr;
				<a href="#">Act on it!</a>
				<ul>
					<li><a href="#">Source: News</a></li>
					<li><a href="#">Source: Vote Data</a></li>
				</ul>
			</li>
			<li>Here is a fact &rarr;
				<a href="#">Act on it!</a>
				<ul>
					<li><a href="#">Source: News</a></li>
					<li><a href="#">Source: Vote Data</a></li>
				</ul>
			</li>
		</ul>
		<button>Contribute To The Knowledge Base</button>
	</section>
</main>
<section class="addAction">
	<h1>Join <?php echo $causename; ?></h1>
	<button>Create Event</button>
	<button>Start A New Petition</button>
</section>

</body>
</html>