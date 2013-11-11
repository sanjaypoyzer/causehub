<?php
/*
$db_host = "93.189.2.202";
$db_username = "causehub_user";
$db_pass = "jamieislame69";
$db_name = "causehub_causehub";
*/
$db_host = "localhost";
$db_username = "causehub";
$db_pass = "pass";
$db_name = "causehub";

mysql_connect("$db_host","$db_username","$db_pass") or die ("Could not connect to MySQL");
mysql_select_db("$db_name") or die ("No Database");
?>
