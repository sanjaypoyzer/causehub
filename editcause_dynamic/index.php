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
		header('location:/cause/'.$slug);
		exit;
	}

	if(!$pagefound){
		header('location:/cause/'.$slug);
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>CauseHub | Editing <?php echo $causename; ?></title>
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="/scripts/editcause.js"></script>
  <script src="/scripts/editcause_updateformactions.js"></script>
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
<main class="edit">
	<section class="causeDescription">
		<h1><?php echo $causename; ?></h1>
		<form method='post' action='#' onsubmit="return false;">
		<label>http://causehub.co/cause/</label>
		<input type='hidden' id='causeid' value='<?php echo $causeid; ?>'>
		<input type='text' id='editslug' value='<?php echo $slug; ?>'>
		<input type='submit' id='editslugbtn' value='Update' onclick='editCauseSlug(); return false;'>
		</form>
		<br>
		<form method='post' action='#' onsubmit="return false;">
		<input type='hidden' id='causeid' value='<?php echo $causeid; ?>'>
		<textarea id='editdescription'><?php echo $causedescription; ?></textarea>
		<input type='submit' id='editdescriptionbtn' value='Update' onclick='editCauseDescription(); return false;'>
		</form>
	</section>
	<section class="knowledgeBaseSummary">
		<form action="" autocomplete="on">
			<h2>Knowledge Base</h2>
			Fact: <input type="text" name="knowledgePoint" autocomplete="off"><br>
			Source (URL): <input type="text" name="knowledgeSource" autocomplete="off"><br>
			Action Type: <select name="actionType" id='actiontype' onchange='updateActionForm()'>
				<option value="lobbyLord">Lobby A Lord</option>
				<option value="lobbyMP">Lobby An MP</option>
				<option value="lobbyMedia">Email A Media Outlet</option>
				<option value="createPetition">Create A Petition</option>
				<option value="hostEvent">Host An Event</option>
			</select><br>
				<section id='lobbyLord' class="lobbyLord">
					Lord: <input type="text" name="lordName" autocomplete="off"><br>
					Email Address: <input type="text" name="lordEmail" autocomplete="off"><br>
					Message: <input size="100" type="text" name="lordEmailDefaultMsg" autocomplete="off"><br>
				</section>

			<input type="submit">
			<button>Add Another</button>
		</form>
	</section>
</main>

</body>
</html>
