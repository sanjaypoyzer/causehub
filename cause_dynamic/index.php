<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/plugins/Parsedown/parsedown.php');

	if(checkSession()){$loggedin = true;} else {$loggedin = false;}

	$slug = $_GET['slug'];
	$sql = mysql_query("SELECT id,uid,name,slug,banner,description,tags,lobbys,hidden FROM causes WHERE slug='$slug' AND deleted='0'");
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
	$causelobbys = $row['lobbys'];
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
	<meta name="description" content="A decentralised, open-source toolkit to bring people around a common cause.">
	<meta name="keywords" content="CauseHub,Cause,Hub,Community,Common,Tool,Toolkit,Decentralised,Open-Source,World,<?php echo $causetags; ?>">
	<meta name="author" content="CauseHub">

	<link rel="stylesheet" href="/css/style.css">

	<link rel="stylesheet" href="/plugins/alertify/alertify.core.css" />
	<link rel="stylesheet" href="/plugins/alertify/alertify.default.css" />

	<link rel="stylesheet" href="/plugins/nprogress/nprogress.css" />
</head>
<body>
	<?php include ($_SERVER['DOCUMENT_ROOT'].'/scripts/header-include.php'); ?>
	<div style="width: 100%; top: 0px; height: 200px; z-index: -99; background: url(/usercontent/causebanners/<?php echo $causebanner; ?>) no-repeat center center; background-size: cover;"></div>
	<main>
		<section class="causeDescription" id="causeDescription">
			
		<?php 
			if($ownerid==getCurrentUserInfo('id') || checkAdmin()){
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
			<h2>Action Base</h2>
			<ul>
			<?php
				$total = 0;
				$sql = mysql_query("SELECT * FROM actionbase WHERE cid='$causeid' AND deleted='0' ORDER BY id DESC");
				while($array = mysql_fetch_array($sql)){
					if($array['action']=='petition'){
						$actionid = $array['actionid'];
						$sqldata = mysql_query("SELECT * FROM action_petition WHERE id='$actionid'");
						$row = mysql_fetch_array($sqldata);
						echo '<li>'.$row['atext'].' &rarr; <a href="'.$row['link'].'" target=_blank>Sign it!</a></li>';
					} else if($array['action']=='event'){
						$actionid = $array['actionid'];
						$sqldata = mysql_query("SELECT * FROM action_event WHERE id='$actionid'");
						$row = mysql_fetch_array($sqldata);
						echo '<li>'.$row['atext'].' &rarr; <a href="'.$row['link'].'" target=_blank>Join it!</a></li>';
					} else if($array['action']=='other'){
						$actionid = $array['actionid'];
						$sqldata = mysql_query("SELECT * FROM action_other WHERE id='$actionid'");
						$row = mysql_fetch_array($sqldata);
						echo '<li>'.$row['atext'].' &rarr; <a href="'.$row['link'].'" target=_blank>Join it!</a></li>';
					}
					$total++;
				}

				if($total==0){
					echo '<li>No entries added to the action base</li>';
				}
			?>
			</ul>
				<?php
				if($causelobbys==''){
					goto nolobbys;
				}
				?>
					<h3>Lobby An MP</h3>
					<div id='lobbylist' class="actionPoints">
						<?php
							$exp = explode(':', $causelobbys);
							$i = 0;
							while($i<count($exp)){
								$sql = mysql_query("SELECT first_name,last_name FROM mp WHERE id='".$exp[$i]."'");
								$row = mysql_fetch_array($sql);
								$csubject = rawurlencode($causename);
								echo '<a href="mailto:name@example.com?subject='.$csubject.'"><button style="margin-bottom: 5px; width: 100%;">'.$row['first_name'].' '.$row['last_name'].'</button></a><br>';
								$i++;
							}
						?>
					</div>
				<?php
					nolobbys:
				?>

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
	<?php include ($_SERVER['DOCUMENT_ROOT'].'/scripts/feedback-include.php'); ?>
</body>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script><script src="/scripts/extra.js"></script>
	<script src="/plugins/alertify/alertify.js"></script>
	<script src="/plugins/nprogress/nprogress.js"></script>
	<script type="text/javascript">

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
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-45734252-1', 'causehub.co');
	  ga('send', 'pageview');
	</script>
</html>