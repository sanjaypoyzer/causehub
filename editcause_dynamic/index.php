<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');

	if(checkSession()){$loggedin = true;} else {$loggedin = false;}

	$slug = $_GET['slug'];
	$sql = mysql_query("SELECT id,uid,name,slug,banner,description,tags,hidden FROM causes WHERE slug='$slug' AND deleted='0'");
	$logincheck = mysql_num_rows($sql);
	$pagefound = false;
	if($logincheck!=0){
		$pagefound = true;
	}
	
	$row = mysql_fetch_array($sql);
	$causeid = $row['id'];
	$ownerid = $row['uid'];
	$causename = $row['name'];
	$causebanner = $row['banner'];
	$causedescription = $row['description'];
	$causetags = $row['tags'];
	$causestart = $row['started'];
	$causehidden = $row['hidden'];

	if($ownerid!=getCurrentUserInfo('id') && !checkAdmin()){
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
	<title>CauseHub. | Editing <?php echo $causename; ?></title>
	<meta name="description" content="A decentralised, open-source toolkit to bring people around a common cause.">
	<meta name="keywords" content="CauseHub,Cause,Hub,Community,Common,Tool,Toolkit,Decentralised,Open-Source,World">
	<meta name="author" content="CauseHub">

	<link rel="stylesheet" href="/css/style.css">

	<link rel="stylesheet" href="/plugins/alertify/alertify.core.css" />
	<link rel="stylesheet" href="/plugins/alertify/alertify.default.css" />

	<link rel="stylesheet" href="/plugins/nprogress/nprogress.css" />

	<link rel="stylesheet" href="/plugins/SirTrevor/css/sir-trevor.css" />
	<link rel="stylesheet" href="/plugins/SirTrevor/css/sir-trevor-icons.css" />

	<link rel="stylesheet" href="/plugins/tagsinput/jquery.tagsinput.css" />
</head>
<body>
	<?php include ($_SERVER['DOCUMENT_ROOT'].'/scripts/header-include.php'); ?>
	<main class="edit">
		<section class="causeDescription">
			<header>
				<span class="hint titleHint">Your Cause Is:</span>
				<h1><?php echo $causename; ?></h1>
			</header>

			<form method='post' action='#' onsubmit="return false;">
			<span class="hint tagsHint">Add some tags that relate to your cause:</span>
			<input type='hidden' id='causeid' value='<?php echo $causeid; ?>'>
			<input type="text" id="causetags" class="tags" value="<?php echo $causetags; ?>"/>
			<input type='submit' id='edittagsbtn' value='Update' onclick='editTags(); return false;' style='margin-top: 10px; display: none;'>
			</form>



			<br /><br /><br />



			<form action='/scripts/processing/processdesc.php?cid=<?php echo $causeid; ?>' id='editdesc' method='POST'>
				<input type='hidden' id='causeid' value='<?php echo $causeid; ?>'>
				<span class="hint descriptionHint">Reasons People Should Join Your Cause Are:</span>
			    <div class="errors"></div>
			    <textarea class="sir-trevor" name="content" id="content"><?php echo $causedescription; ?></textarea>
			    <input type='submit' value='Update' id='editdescriptionbtn' style='margin-top: 10px;'>
			</form>



			<br /><br /><br />



			<form id='uploadform' method='post' action='/scripts/processing/uploadbanner.php?cid=<?php echo $causeid; ?>' enctype="multipart/form-data">
			<span class="hint descriptionHint">Upload a banner image for your cause:</span>
			<div style="width: 100%; top: 0px; height: 150px; background: url(/usercontent/causebanners/<?php echo $causebanner; ?>) no-repeat center center; background-size: cover; cursor: pointer;" onclick="$('input[type=file]').click();"></div>
			<input type='file' id='file' name='file' style='display: none;'>
			</form>



			<br /><br /><br />



			<form method='post' action='#' onsubmit="return false;">
				<span class="hint slugHint">People Can Find It At:</span>
			<label>http://causehub.co/cause/</label>
			<input type='hidden' id='causeid' value='<?php echo $causeid; ?>'>
			<input type='text' id='editslug' value='<?php echo $slug; ?>'>
			<input type='submit' id='editslugbtn' value='Update' onclick='editCauseSlug(); return false;'>
			</form>



			<br /><br /><br />



			<form method='post' action='#' onsubmit="return false;">
				<span class="hint slugHint">Edit cause settings:</span>
			<input type='hidden' id='causeid' value='<?php echo $causeid; ?>'>
			<input type='submit' class="warningBtn" id='deletecausebtn' value='Delete Cause' onclick='deleteCause(); return false;'>
			</form>

		</section>
		<section class="knowledgeBaseSummary">
			<form method='post' action="#" onsubmit="return false;" autocomplete="on" id="addAction">
				<h2>Lobby An MP</h2>
				<div id='lobbylist'>
					<button style="margin-bottom: 5px; width: 100%;">Loading...</button><br>
					<button style="margin-bottom: 5px; width: 100%;">Loading...</button><br>
					<button style="margin-bottom: 5px; width: 100%;">Loading...</button><br>
					<button style="margin-bottom: 5px; width: 100%;">Loading...</button><br>
					<button style="margin-bottom: 5px; width: 100%;">Loading...</button>
				</div>
				<h2>Action Base</h2>
				 <input type='hidden' id='causeid' value='<?php echo $causeid; ?>'>
				<span class="knowledgeBaseHint hint">Add actions people can do to help your cause:</span>
				 <select name="actionType" id='action_type' onchange='updateActionForm()'>
					<option value="petition">Petiton</option>
					<option value="event">Event</option>
					<option value="other">Other</option>
				</select>
				<section id='actioninfo' class="actioninfo">
						Action: <input type="text" id="action_text" autocomplete="off" value="Sign this Petition"><br>
						Link: <input type="text" id="action_link" autocomplete="off">
				</section>
				<input type="submit" id='action_btn' value='Add Action' onclick='addAction(); return false;'>
			</form>
		</section>

		<section class="knowledgeBaseSummary" id='actionpointlist'></section>

		<?php
		if($causehidden=='1'){
			$publishbtntext = 'Start changing the world! &rarr;';
		} else {
			$publishbtntext = 'View Cause &rarr;';
		}
		?>
			<button class="publishbtn" id="publishbtn" onclick="publish('<?php echo $causeid; ?>');"><?php echo $publishbtntext; ?></button>
	</main>
	<?php include ($_SERVER['DOCUMENT_ROOT'].'/scripts/feedback-include.php'); ?>
</body>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script><script src="/scripts/extra.js"></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js'></script>
	<script src="/scripts/editcause.js"></script>
	<script src="/scripts/editcause_actions.js"></script>
	<script src="/plugins/alertify/alertify.js"></script>
	<script src="/plugins/nprogress/nprogress.js"></script>
	<script src="/plugins/SirTrevor/js/underscore.js"></script>
	<script src="/plugins/SirTrevor/js/eventable.js"></script>
	<script src="/plugins/tagsinput/jquery.tagsinput.js"></script>
	<script src="/plugins/SirTrevor/js/sir-trevor.js"></script>
	<script type="text/javascript" charset="utf-8">
	    $(function(){

	      window.editor = new SirTrevor.Editor({
	        el: $('.sir-trevor'),
	        blockTypes: [
	          "Heading",
	          "Text",
	          "Quote",
	          "List",
	          "Video",
	          "Embedly"
	        ]
	      });
	      SirTrevor.setDefaults({
			uploadUrl: "/images"
	      });

	    });
	    document.getElementById("file").onchange = function() {
		    document.getElementById("uploadform").submit();
		};
		$(function() {
			$('#causetags').tagsInput({width:'auto','onAddTag':function(element){updateLobbyList("add")},'onRemoveTag':function(element){updateLobbyList("add")}});
		});
		$(document).ready(function() {
			updateLobbyList("load");
			updateActionList();
		});
	</script>
	<?php
		if($_SESSION['upload_msg']!=''){
			$parts = explode(':', $_SESSION['upload_msg']);
			echo '<script>';
			echo 'alertify.log("'.$parts[1].'","'.$parts[0].'");';
			echo '</script>';
			unset($_SESSION['upload_msg']);
		}
	?>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-45734252-1', 'causehub.co');
	  ga('send', 'pageview');
	</script>
</html>
