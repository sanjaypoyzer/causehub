<?php
$db_host = "127.0.0.1";
$db_username = "causehub";
$db_pass = "pass";
$db_name = "causehub";

mysql_connect("$db_host","$db_username","$db_pass") or die ("Could not connect to MySQL");
mysql_select_db("$db_name") or die ("No Database");
?>