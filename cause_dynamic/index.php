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

	$causenamesubject = str_replace(' ', '%20', $causename);

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
  <title>CauseHub. | <?php echo $causename; ?></title>
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="/scripts/editcause.js"></script>
  <script src="/scripts/addpetition.js"></script>
  <script src="/plugins/alertify/alertify.js"></script>
  <link rel="stylesheet" href="/plugins/alertify/alertify.core.css" />
  <link rel="stylesheet" href="/plugins/alertify/alertify.default.css" />
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
	<img src="http://lorempixel.com/1200/200/" class="causeImg" />
<main>
	<section class="causeDescription">
		
	<?php 
		if($ownerid==getCurrentUserInfo('id')){
			echo '<a href="/editcause/'.$slug.'/" class="editlink"><button class="publishbtn">&larr; Manage Cause</button></a>';
		}
	?>
		<h1><?php echo $causename; ?></h1>
		<?php echo $causedescription; ?>
	</section>
	<section class="knowledgeBaseSummary">
		<h2>Knowledge Base</h2>
		<ul>
		<?php
			$sql = mysql_query("SELECT * FROM knowledgebase WHERE cid='$causeid' AND deleted='0'");
			while($array = mysql_fetch_array($sql)){
				if($array['action']=='lobbyLord'){
					$actionid = $array['actionid'];
					$sqlemail = mysql_query("SELECT * FROM kb_action_lobbylord WHERE id='$actionid'");
					$row = mysql_fetch_array($sqlemail);
					$message = rawurlencode($row['message']);
					echo '<li>'.$array['fact'].' &rarr; <a href="mailto:'.$row['address'].'?Subject='.$causenamesubject.'&Body='.$message.'">Act on it!</a>';
					echo '<ul><li><a href="'.$array['source'].'" target=_blank title="'.$array['source'].'">Source: '.$array['sourcetitle'].'</a></li></ul></li>';
				} else if($array['action']=='lobbyMP'){
					$actionid = $array['actionid'];
					$sqlemail = mysql_query("SELECT * FROM kb_action_lobbymp WHERE id='$actionid'");
					$row = mysql_fetch_array($sqlemail);
					$message = rawurlencode($row['message']);
					echo '<li>'.$array['fact'].' &rarr; <a href="mailto:'.$row['address'].'?Subject='.$causenamesubject.'&Body='.$message.'">Act on it!</a>';
					echo '<ul><li><a href="'.$array['source'].'" target=_blank title="'.$array['source'].'">Source: '.$array['sourcetitle'].'</a></li></ul></li>';
				} else if($array['action']=='lobbyMedia'){
					$actionid = $array['actionid'];
					$sqlemail = mysql_query("SELECT * FROM kb_action_lobbymedia WHERE id='$actionid'");
					$row = mysql_fetch_array($sqlemail);
					$message = rawurlencode($row['message']);
					echo '<li>'.$array['fact'].' &rarr; <a href="mailto:'.$row['address'].'?Subject='.$causenamesubject.'&Body='.$message.'">Act on it!</a>';
					echo '<ul><li><a href="'.$array['source'].'" target=_blank title="'.$array['source'].'">Source: '.$array['sourcetitle'].'</a></li></ul></li>';
				} else if($array['action']=='createPetition'){
					$actionid = $array['actionid'];
					$sqlemail = mysql_query("SELECT * FROM kb_action_petitions WHERE id='$actionid'");
					$row = mysql_fetch_array($sqlemail);
					echo '<li>'.$array['fact'].' &rarr; <a href="/petition/'.$row['slug'].'/" target=_blank>Act on it!</a>';
					echo '<ul><li><a href="'.$array['source'].'" target=_blank title="'.$array['source'].'">Source: '.$array['sourcetitle'].'</a></li></ul></li>';
				} else if($array['action']=='hostEvent'){
					$actionid = $array['actionid'];
					$sqlemail = mysql_query("SELECT * FROM kb_action_hostevent WHERE id='$actionid'");
					$row = mysql_fetch_array($sqlemail);
					echo '<li>'.$array['fact'].' &rarr; <a href="'.$row['url'].'" target=_blank>Act on it!</a>';
					echo '<ul><li><a href="'.$array['source'].'" target=_blank title="'.$array['source'].'">Source: '.$array['sourcetitle'].'</a></li></ul></li>';
				}
			}
		?>
		</ul>
	</section>
	
</main>
<section class="addAction">
	<h1>Help <?php echo $causename; ?></h1>
	<button>Lobby An MP</button>
	<button>Lobby A Lord</button>
	<button>Lobby A Media Source</button>
	<button>Post Event</button>
	<button>Start A Petition</button>
</section>
<script type="text/javascript">
$(document).ready(function(){
  $('section.addAction').hover(
    function(){
      $(this).css('bottom','0');
    },
    function(){
      $(this).css('bottom','-3em');
    }
  );
});
                               
</script>
</body>
</html>