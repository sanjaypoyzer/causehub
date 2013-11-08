<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');

	if(checkSession()){$loggedin = true;} else {$loggedin = false;}

	$slug = $_GET['slug'];
	$sql = mysql_query("SELECT id,name,description FROM kb_action_petitions WHERE slug='$slug'");
	$logincheck = mysql_num_rows($sql);
	$pagefound = false;
	if($logincheck!=0){
		$pagefound = true;
	}
	
	$row = mysql_fetch_array($sql);
	$petitionid = $row['id'];
	$petitionname = $row['name'];
	$petitiondescription = $row['description'];


	if(!$pagefound){
		echo 'Cause not found';
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>CauseHub. | <?php echo $petitionname; ?></title>
	<link rel="stylesheet" href="/css/style.css">

	<link rel="stylesheet" href="/plugins/alertify/alertify.core.css" />
	<link rel="stylesheet" href="/plugins/alertify/alertify.default.css" />

	<link rel="stylesheet" href="/plugins/nprogress/nprogress.css" />
</head>
<body>
	<?php include ($_SERVER['DOCUMENT_ROOT'].'/scripts/header-include.php'); ?>
	<main class="petition">	
		<h1><?php echo $petitionname; ?></h1>
		<p><?php echo $petitiondescription; ?></p>
		<h2>Sign This Petition:</h2>
			<form method='post' action='#' onsubmit="return false;">
			  <input type="hidden" id="pid" value="<?php echo $petitionid; ?>" />
			  First Name: <input type="text" id="fname" size="15" /><br />
			  Last Name: <input type="text" id="lname" size="15" /><br />
			  Email: <input type="email" id="email" size="15" /><br />
			  <input type='submit' id='addsignaturebtn' value='Add Signature' onclick='addPetitionSig(); return false;'>
			</form>
		<h2>Who has signed this petition</h2>
		<ul>
			<?php
				$sql = mysql_query("SELECT * FROM petition_signatures WHERE pid='$petitionid' ORDER BY id DESC");
				while($array = mysql_fetch_array($sql)){
					echo '<li>'.$array['fname'].' '.$array['lname'].'</li>';
				}
			?>
		</ul>
	</main>
	<?php include ($_SERVER['DOCUMENT_ROOT'].'/scripts/feedback-include.php'); ?>
</body>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script><script src="/scripts/extra.js"></script>
	<script src="/scripts/addpetition.js"></script>
	<script src="/plugins/alertify/alertify.js"></script>
	<script src="/plugins/nprogress/nprogress.js"></script>
</html>
