<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');

	$entered = $_POST['entered'];
	if($entered==''){
		exit;
	}

	$enteredsql = mysql_real_escape_string($entered);
	$sql = mysql_query("SELECT * FROM causes WHERE name LIKE '%".$enteredsql."%' AND hidden='0' AND deleted='0'");
	while($array = mysql_fetch_array($sql)){
		$return = str_replace(strtolower($enteredsql), '<b>'.ucwords($enteredsql).'</b>', strtolower($array['name']));
		echo '
		<a href="/cause/'.$array['slug'].'/">
			<figure>
			  <img src="http://placehold.it/200x100" alt="'.ucwords($return).'">
			  <figcaption>'.ucwords($return).'</figcaption>
			</figure>
		</a>
		';
	}
	exit;
?>