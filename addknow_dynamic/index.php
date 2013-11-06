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

	if(!$loggedin){
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
	<title>CauseHub. | Add to the knowledge base for <?php echo $causename; ?></title>
	<link rel="stylesheet" href="/css/style.css">

	<link rel="stylesheet" href="/plugins/alertify/alertify.core.css" />
	<link rel="stylesheet" href="/plugins/alertify/alertify.default.css" />

	<link rel="stylesheet" href="/plugins/nprogress/nprogress.css" />
</head>
<body>
	<?php include ($_SERVER['DOCUMENT_ROOT'].'/scripts/header-include.php'); ?>
	<main class="petition">
		<h1>Help <?php echo $causename; ?></h1>
			<form method='post' action="#" onsubmit="return false;" autocomplete="on">
				<span class="knowledgeBaseHint hint">An important thing people should know about this cause is:</span> <input type='hidden' id='causeid' value='<?php echo $causeid; ?>'>
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
						Description: <textarea size="100" id="createpetition_description">Write a short description about the petition</textarea><br>
					</section>
					<section id='hostEvent' class="lobby" style='display: none;'>
						Name: <input type="text" id="hostevent_name" autocomplete="off"><br>
						URL: <input type="text" id="hostevent_url" autocomplete="off"><br>
					</section>


				<input type="submit" id='addknowledgebtn' value='Add' onclick='addKnowledge(); return false;'>
			</form>
	</main>
	<?php include ($_SERVER['DOCUMENT_ROOT'].'/scripts/feedback-include.php'); ?>
</body>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script><script src="/scripts/extra.js"></script>
	<script src="/scripts/editcause_updateformactions_other.js"></script>
	<script src="/plugins/alertify/alertify.js"></script>
	<script src="/plugins/nprogress/nprogress.js"></script>
</html>
