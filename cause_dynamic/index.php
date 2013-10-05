<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');

	if(checkSession()){$loggedin = true;} else {$loggedin = false;}

	$slug = $_GET['slug'];
	$sql = mysql_query("SELECT id,uid,name,slug,description FROM causes WHERE slug='$slug' AND hidden='0' AND deleted='0'");
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

	if(!$pagefound){
		echo 'Cause not found';
		exit;
	}
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="/scripts/editcause.js"></script>

<script src="/plugins/alertify/alertify.js"></script>
<link rel="stylesheet" href="/plugins/alertify/alertify.core.css" />
<link rel="stylesheet" href="/plugins/alertify/alertify.default.css" />

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