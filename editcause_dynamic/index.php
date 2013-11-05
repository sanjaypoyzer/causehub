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
	<title>CauseHub. | Editing <?php echo $causename; ?></title>
	<link rel="stylesheet" href="/css/style.css">

	<link rel="stylesheet" href="/plugins/alertify/alertify.core.css" />
	<link rel="stylesheet" href="/plugins/alertify/alertify.default.css" />

	<link rel="stylesheet" href="/plugins/nprogress/nprogress.css" />

	<link rel="stylesheet" href="/plugins/SirTrevor/css/sir-trevor.css" />
	<link rel="stylesheet" href="/plugins/SirTrevor/css/sir-trevor-icons.css" />
</head>
<body>
	<header>
		<a href="/getmps.php"><button class="searchbtn">Search InfoHub</button></a>
		<h1><a href="/">CauseHub.</a></h1>
		<?php
			if($loggedin){
				echo '<span class="loggedin">Welcome back, <a href="/dash">'.getCurrentUserInfo('fname').' '.getCurrentUserInfo('lname').'</a> | <a href="/scripts/logout.php" class="logout">Logout</a></span>';
			} else {
				echo '<span class="login"><a href="/login"><button>Login</button></a><a href="/Register"><button>Register</button></a></span>';
			}
		?>
	</header>
	<main class="edit">
		<section class="causeDescription">
			<header>
				<span class="hint titleHint">Your Cause Is:</span>
				<h1><?php echo $causename; ?></h1>
			</header>

			<form action='/scripts/processdesc.php?cid=<?php echo $causeid; ?>' method='POST'>
				<input type='hidden' id='causeid' value='<?php echo $causeid; ?>'>
				<span class="hint descriptionHint">Reasons People Should Join Your Cause Are:</span>
			    <div class="errors"></div>
			    <textarea class="sir-trevor" name="content"><?php echo $causedescription; ?></textarea>
			    <input type='submit' value='Update' id='editdescriptionbtn'>
			</form>


			<br /><br /><br />
			<form id='uploadform' method='post' action='/scripts/uploadbanner.php' enctype="multipart/form-data">
			<span class="hint descriptionHint">Upload a banner image for your cause:</span>
			<input type='file' id='file' >
			</form>
			<br /><br /><br />
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
		</section>

		<section class="knowledgeBaseSummary">
			<ul>
			<?php
				$total = 0;
				$sql = mysql_query("SELECT * FROM knowledgebase WHERE cid='$causeid' AND deleted='0' ORDER BY id DESC");
				while($array = mysql_fetch_array($sql)){
					if($array['action']=='lobbyLord'){
						$actionid = $array['actionid'];
						$sqlemail = mysql_query("SELECT * FROM kb_action_lobbylord WHERE id='$actionid'");
						$row = mysql_fetch_array($sqlemail);
						$message = rawurlencode($row['message']);
						echo '<li>'.$array['fact'].' &rarr; <a href="mailto:'.$row['address'].'?Subject='.$causenamesubject.'&Body='.$message.'">Email them!</a>';
						echo '<ul><li><a href="'.$array['source'].'" target=_blank title="'.$array['source'].'">Source: '.$array['sourcetitle'].'</a></li></ul></li>';
					} else if($array['action']=='lobbyMP'){
						$actionid = $array['actionid'];
						$sqlemail = mysql_query("SELECT * FROM kb_action_lobbymp WHERE id='$actionid'");
						$row = mysql_fetch_array($sqlemail);
						$message = rawurlencode($row['message']);
						echo '<li>'.$array['fact'].' &rarr; <a href="mailto:'.$row['address'].'?Subject='.$causenamesubject.'&Body='.$message.'">Email them!</a>';
						echo '<ul><li><a href="'.$array['source'].'" target=_blank title="'.$array['source'].'">Source: '.$array['sourcetitle'].'</a></li></ul></li>';
					} else if($array['action']=='lobbyMedia'){
						$actionid = $array['actionid'];
						$sqlemail = mysql_query("SELECT * FROM kb_action_lobbymedia WHERE id='$actionid'");
						$row = mysql_fetch_array($sqlemail);
						$message = rawurlencode($row['message']);
						echo '<li>'.$array['fact'].' &rarr; <a href="mailto:'.$row['address'].'?Subject='.$causenamesubject.'&Body='.$message.'">Email them!</a>';
						echo '<ul><li><a href="'.$array['source'].'" target=_blank title="'.$array['source'].'">Source: '.$array['sourcetitle'].'</a></li></ul></li>';
					} else if($array['action']=='createPetition'){
						$actionid = $array['actionid'];
						$sqlemail = mysql_query("SELECT * FROM kb_action_petitions WHERE id='$actionid'");
						$row = mysql_fetch_array($sqlemail);
						echo '<li>'.$array['fact'].' &rarr; <a href="/petition/'.$row['slug'].'/" target=_blank>Sign it!</a>';
						echo '<ul><li><a href="'.$array['source'].'" target=_blank title="'.$array['source'].'">Source: '.$array['sourcetitle'].'</a></li></ul></li>';
					} else if($array['action']=='hostEvent'){
						$actionid = $array['actionid'];
						$sqlemail = mysql_query("SELECT * FROM kb_action_hostevent WHERE id='$actionid'");
						$row = mysql_fetch_array($sqlemail);
						echo '<li>'.$array['fact'].' &rarr; <a href="'.$row['url'].'" target=_blank>Attend!</a>';
						echo '<ul><li><a href="'.$array['source'].'" target=_blank title="'.$array['source'].'">Source: '.$array['sourcetitle'].'</a></li></ul></li>';
					}
					$total++;
				}

				if($total==0){
					echo '<li>No entries added to the knowledgebase yet</li>';
				}
			?>
			</ul>
		</section>
		<?php
		if($causehidden=='0'){
			goto published;
		}
		?>
			<button class="publishbtn" id="publishbtn" onclick="publish('<?php echo $causeid; ?>');">Start changing the world! &rarr;</button>
		<?php
		goto othergoto;
		published:
		?>
			<a href="/cause/<?php echo $slug; ?>/"><button class="publishbtn">View Cause &rarr;</button></a>
		<?php
		othergoto:
		?>
	</main>
	<?php include ($_SERVER['DOCUMENT_ROOT'].'/scripts/feedback-include.php'); ?>
</body>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script><script src="/scripts/extra.js"></script>
	<script src="/scripts/editcause.js"></script>
	<script src="/scripts/editcause_updateformactions.js"></script>
	<script src="/plugins/alertify/alertify.js"></script>
	<script src="/plugins/nprogress/nprogress.js"></script>
	<script src="/plugins/SirTrevor/js/underscore.js"></script>
	<script src="/plugins/SirTrevor/js/eventable.js"></script>
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
	</script>
</html>
