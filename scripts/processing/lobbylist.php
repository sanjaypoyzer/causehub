<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');

	$postcauseid = $_POST['cid'];
	$posttype = $_POST['type'];
	$postcausetags = $_POST['tags'];
	$userid = getCurrentUserInfo('id');

	$sql = mysql_query("SELECT id,uid,name,slug,description,lobbys FROM causes WHERE id='$postcauseid'");
	
	$row = mysql_fetch_array($sql);
	$causeid = $row['id'];
	$ownerid = $row['uid'];
	$causename = $row['name'];
	$causedescription = $row['description'];
	$causelobbys = $row['lobbys'];
	$causestart = $row['started'];
	$causeslug = $row['slug'];

	if($postcausetags!='' && $causelobbys==''){
		$sql = mysql_query("SELECT * FROM mp WHERE first_name!='' AND last_name!='' ORDER BY RAND() LIMIT 5");
		while($array = mysql_fetch_array($sql)){
			echo '<a href="/scripts/processing/lobbylist_add.php?cid='.$causeid.'&lid='.$array['id'].'"><button style="margin-bottom: 5px; width: 100%;">'.$array['first_name'].' '.$array['last_name'].' <span style="float: right;">&#43;</span></button></a><br>';
		}
	} else if($postcausetags!='' && $causelobbys!=''){
		$exp = explode(':', $causelobbys);
		$i = 0;
		while($i<count($exp)){
			$sql = mysql_query("SELECT first_name,last_name FROM mp WHERE id='".$exp[$i]."'");
			$row = mysql_fetch_array($sql);
			echo '<a href="/scripts/processing/lobbylist_add.php?cid='.$causeid.'&lid='.$exp[$i].'"><button style="margin-bottom: 5px; width: 100%;">'.$row['first_name'].' '.$row['last_name'].' <span style="float: right;">-</span></button></a><br>';
			$i++;
		}
		$left = 5 - $i;
		$sql = mysql_query("SELECT * FROM mp WHERE first_name!='' AND last_name!='' ORDER BY RAND() LIMIT ".$left);
		while($array = mysql_fetch_array($sql)){
			echo '<a href="/scripts/processing/lobbylist_add.php?cid='.$causeid.'&lid='.$array['id'].'"><button style="margin-bottom: 5px; width: 100%;">'.$array['first_name'].' '.$array['last_name'].' <span style="float: right;">&#43;</span></button></a><br>';
		}
	} else {
		echo '<button style="margin-bottom: 5px; width: 100%;">Please add some tags</button><br>';
		echo '<button style="margin-bottom: 5px; width: 100%;">Please add some tags</button><br>';
		echo '<button style="margin-bottom: 5px; width: 100%;">Please add some tags</button><br>';
		echo '<button style="margin-bottom: 5px; width: 100%;">Please add some tags</button><br>';
		echo '<button style="margin-bottom: 5px; width: 100%;">Please add some tags</button>';
	}

?>