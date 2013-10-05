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

	if($ownerid!=getCurrentUserInfo('id') && $causehidden=='1'){
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
	<h1>CauseHub</h1>
	<?php
		if($loggedin){
			echo '<span class="loggedin">Welcome back, '.getCurrentUserInfo('fname').' '.getCurrentUserInfo('lname').'</span>';
		} else {
			echo '<span class="login"><a href="/login"><button>Login</button></a><a href="/signup"><button>Signup</button></a></span>';
		}
	?>
</header>
	<img src="http://lorempixel.com/1200/200/" class="causeImg" />
<main>
	<section class="causeDescription">
		<h1><?php echo $causename; ?></h1>
		<?php echo $causedescription; ?>
	</section>
	<section class="knowledgeBaseSummary">
		<h1>Knowledge Base</h1>
		<ul>
		<?php
			$sql = mysql_query("SELECT * FROM knowledgebase WHERE cid='$causeid' AND deleted='0'");
			while($array = mysql_fetch_array($sql)){
				echo '<li>'.$array['fact'].' &rarr; <a href="#">Act on it!</a>';
				echo '<ul><li><a href="'.$array['source'].'" target=_blank>Source: '.$array['sourcetitle'].'</a></li></ul></li>';
			}
		?>
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