<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/plugins/Parsedown/parsedown.php');

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

	if($causehidden=='1'){
		header('location:/editcause/'.$slug.'/');
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>CauseHub. | <?php echo $causename; ?></title>
	<link rel="stylesheet" href="/css/style.css">

	<link rel="stylesheet" href="/plugins/alertify/alertify.core.css" />
	<link rel="stylesheet" href="/plugins/alertify/alertify.default.css" />

	<link rel="stylesheet" href="/plugins/nprogress/nprogress.css" />
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
		<img src="http://lorempixel.com/1200/200/" class="causeImg" />
	<main>
		<section class="causeDescription" id="causeDescription">
			
		<?php 
			if($ownerid==getCurrentUserInfo('id')){
				echo '<a href="/editcause/'.$slug.'/" class="editlink"><button class="publishbtn">&larr; Manage Cause</button></a>';
			}
		?>
			<h1><?php echo $causename; ?></h1>
			<!-- START DESCRIPTION RENDERING -->

			<?php
				$json = $causedescription;
				$jsondescarray = json_decode($json,true);

				$descitems = count($jsondescarray['data']);

				for($i=0;$i<$descitems;$i++){
					$itemtype = $jsondescarray['data'][$i]['type'];
					if($itemtype=='heading'){
						$data = Parsedown::instance()->parse($jsondescarray['data'][$i]['data']['text']);
						echo '<div style="width: 100%; margin-bottom: 10px;"><h2>'.$data.'</h2></div>';
					} else if($itemtype=='text'){
						$data = Parsedown::instance()->parse($jsondescarray['data'][$i]['data']['text']);
						echo '<div style="width: 100%; margin-bottom: 20px;"><p>'.$data.'</p></div>';
					} else if($itemtype=='quote'){
						echo '<div style="width: 100%; margin-bottom: 20px;">'.Parsedown::instance()->parse(substr($jsondescarray['data'][$i]['data']['text'], 2)).'--<i>'.Parsedown::instance()->parse($jsondescarray['data'][$i]['data']['cite']).'</i></div>';
					} else if($itemtype=='list'){
						$data = Parsedown::instance()->parse($jsondescarray['data'][$i]['data']['text']);
						echo '<div style="width: 100%; margin-bottom: 20px;"><p>'.$data.'</p></div>';
					} else if($itemtype=='video'){
						if($jsondescarray['data'][$i]['data']['source']=='youtube'){
							$embedcode = '<iframe width="300" height="180" src="http://www.youtube.com/embed/'.$jsondescarray['data'][$i]['data']['remote_id'].'?rel=0&amp;hd=0" frameborder="0"></iframe>';
						} else if($jsondescarray['data'][$i]['data']['source']=='vimeo'){
							$embedcode = '<iframe src="http://player.vimeo.com/video/'.$jsondescarray['data'][$i]['data']['remote_id'].'" width="300" height="180" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
						} else {
							$embedcode = '<b>Error Loading Video</b>';
						}
						echo '<div style="width: 100%; margin-bottom: 20px;">'.$embedcode.'</div>';
					} else if($itemtype=='embedly'){
						if($jsondescarray['data'][$i]['data']['type']=='photo'){
							echo '<div style="width: 100%; margin-bottom: 20px;"><img src="'.$jsondescarray['data'][$i]['data']['url'].'" width="100%"></div>';
						} else if($jsondescarray['data'][$i]['data']['type']=='rich'){
							echo '<div style="width: 100%; margin-bottom: 20px;">'.$jsondescarray['data'][$i]['data']['html'].'</div>';
						} else {
							echo '<b>Error Loading Video</b>';
						}
					}
				}
			?>

			<!-- DONE DESCRIPTION RENDERING -->
		</section>
		<section class="knowledgeBaseSummary">
			<h2>Knowledge Base</h2>
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
		
	</main>
	<section class="addAction">
		<h1>Help <?php echo $causename; ?></h1>
		<a href='/addknow/<?php echo $slug; ?>/'><button>Lobby A Lord</button></a>
		<a href='/addknow/<?php echo $slug; ?>/'><button>Lobby An MP</button></a>
		<a href='/addknow/<?php echo $slug; ?>/'><button>Lobby A Media Source</button></a>
		<a href='/addknow/<?php echo $slug; ?>/'><button>Start A Petition</button></a>
		<a href='/addknow/<?php echo $slug; ?>/'><button>Post Event</button></a>
	</section>
</body>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script><script src="/scripts/extra.js"></script>
	<script src="/plugins/alertify/alertify.js"></script>
	<script src="/plugins/nprogress/nprogress.js"></script>
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

	$(function() {
		var $allVideos = $("iframe"),
		$fluidEl = $("#causeDescription");
		$allVideos.each(function() {
			$(this)
				.data('aspectRatio', this.height / this.width)
				.removeAttr('height')
				.removeAttr('width');

		});
		$(window).resize(function() {
			var newWidth = $fluidEl.width();
			$allVideos.each(function() {
				var $el = $(this);
				$el
					.width(newWidth)
					.height(newWidth * $el.data('aspectRatio'));
			});
		}).resize();

	}); 
	                
	</script>
</html>