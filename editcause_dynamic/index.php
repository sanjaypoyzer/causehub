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

	$today = date("d/m/Y");
	$oneweek = date("d/m/Y",strtotime("+1 week"));
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>CauseHub.</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>CauseHub | Editing Something cool</title>
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  <script src="/scripts/editcause.js"></script>
  <script src="/scripts/editcause_updateformactions.js"></script>
  <script src="/plugins/alertify/alertify.js"></script>
  <link rel="stylesheet" href="/plugins/alertify/alertify.core.css" />
  <link rel="stylesheet" href="/plugins/alertify/alertify.default.css" />
  <link rel="stylesheet" href="/plugins/jHtmlArea/style/jHtmlArea.css" />
</head>
<body>
<header>
	<h1><a href="/">CauseHub.</a></h1>
	<?php
		if($loggedin){
			echo '<span class="loggedin">Welcome back, <a href="/dash">'.getCurrentUserInfo('fname').' '.getCurrentUserInfo('lname').'</a> | <a href="/scripts/logout.php" class="logout">Logout</a></span>';
		} else {
			echo '<span class="login"><a href="/login"><button>Login</button></a><a href="/signup"><button>Signup</button></a></span>';
		}
	?>
</header>
<main class="edit">
	<section class="causeDescription">
		<header>
			<span class="hint titleHint">Your Cause Is:</span>
			<h1><?php echo $causename; ?></h1>
		</header>
		<form method='post' action='#' onsubmit="return false;">
		<input type='hidden' id='causeid' value='<?php echo $causeid; ?>'>
			<span class="hint descriptionHint">Reasons People Should Join Your Cause Are:</span>
		<textarea id='editdescription'><?php echo $causedescription; ?></textarea>
		<input type='submit' id='editdescriptionbtn' value='Update' onclick='editCauseDescription(); return false;'>
		</form>
		<br />
		<form method='post' action='#' onsubmit="return false;">
			<span class="hint slugHint">People Can Find It At:</span>
		<label>http://causehub.co/cause/</label>
		<input type='hidden' id='causeid' value='<?php echo $causeid; ?>'>
		<input type='text' id='editslug' value='<?php echo $slug; ?>'>
		<input type='submit' id='editslugbtn' value='Update' onclick='editCauseSlug(); return false;'>
		</form>
	</section>
	<section class="knowledgeBaseSummary">
		<form method='post' action="#" onsubmit="return false;" autocomplete="on">
			<h2>Knowledge Base</h2>
			<span class="knowledgeBaseHint hint">An important thing people should know about this cause is:</span> <input type='hidden' id='causeid' value='8'>
			<h3>Fact:</h3> <input type="text" name="knowledgePoint" id='fact' autocomplete="off"><br>
				<section class="factSource">Source (URL): <input type="text" name="knowledgeSource" id='sourceurl' autocomplete="off"></section><br>
			<span class="actionHint hint">What people can do about this is:</span>
			<h3>Action Type:</h3> <select name="actionType" id='actiontype' onchange='updateActionForm()'>
				<option value="lobbyLord">Lobby A Lord</option>
				<option value="lobbyMP">Lobby An MP</option>
				<option value="lobbyMedia">Email A Media Outlet</option>
				<option value="createPetition">Create A Petition</option>
				<option value="hostEvent">Host An Event</option>
			</select><br>
				<section id='lobbyLord' class="lobby">
					Lord: <input type="text" id="lobbylord_name" autocomplete="off"><br>
					Email: <input type="text" id="lobbylord_address" autocomplete="off"><br>
					Message: <textarea size="100" id='lobbylord_message'></textarea><br>
				</section>
				<section id='lobbyMP' class="lobby" style='display: none;'>
					MP: <input type="text" id="lobbymp_name" autocomplete="off"><br>
					Email: <input type="text" id="lobbymp_address" autocomplete="off"><br>
					Message: <textarea size="100" id='lobbymp_message'></textarea><br>
				</section>
				<section id='lobbyMedia' class="lobby" style='display: none;'>
					Media: <input type="text" id="lobbymedia_name" autocomplete="off"><br>
					Email: <input type="text" id="lobbymedia_address" autocomplete="off"><br>
					Message: <textarea size="100" id='lobbymedia_message'></textarea><br>
				</section>
				<section id='createPetition' class="lobby" style='display: none;'>
					Name: <input type="text" id="createpetition_name" autocomplete="off"><br>
					Description: <input type="text" id="createpetition_description" autocomplete="off" value='Write a short description here, (less that 140 characters)'><br>
				</section>


			<input type="submit" id='addknowledgebtn' value='Add' onclick='addKnowledge(); return false;'>
		</form>
	</section>
	<?php
	if($causehidden=='0'){
		goto published;
	}
	?>
		<button class="publishbtn" id="publishbtn" onclick="publish('<?php echo $causeid; ?>');">Start changing the world!</button>
	<?php
	published:
	?>
</main>
  <script type="text/javascript" src="/plugins/jHtmlArea/scripts/jquery-ui-1.7.2.custom.min.js"></script>
  <script type="text/javascript" src="/plugins/jHtmlArea/scripts/jHtmlArea-0.7.5.js"></script>

  <script type="text/javascript">
  $(document).ready(function(){
  	  	$('textarea#editdescription').htmlarea();
  });
  </script>
</body>
</html>
