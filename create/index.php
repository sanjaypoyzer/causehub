<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');

?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="/scripts/create.js"></script>

<script src="/plugins/alertify/alertify.js"></script>
<link rel="stylesheet" href="/plugins/alertify/alertify.core.css" />
<link rel="stylesheet" href="/plugins/alertify/alertify.default.css" />

<form method='post' action='#' onsubmit="return false;">
<input type='text' id='causename' placeholder='Cause Name'>
<input type='submit' id='causecreatebtn' value='Create' onclick='createcause(); return false;'>
</form>