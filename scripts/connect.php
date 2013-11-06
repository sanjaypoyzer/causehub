<?php

///CAUSEHUB INFO START
	
	define(CAUSEHUB_VERSION_NAME, 'Alpha');
	define(CAUSEHUB_VERSION_MAJOR, '1');
	define(CAUSEHUB_VERSION_MINOR, '0');
	define(CAUSEHUB_VERSION_VERSION, '0');
	define(CAUSEHUB_VERSION_BUILD, '0');
	define(CAUSEHUB_VERSION, CAUSEHUB_VERSION_NAME.' '.CAUSEHUB_VERSION_MAJOR.'.'.CAUSEHUB_VERSION_MINOR.'.'.CAUSEHUB_VERSION_VERSION.'.'.CAUSEHUB_VERSION_BUILD.'');

///CAUSEHUB INFO END


$db_host = "localhost";
$db_username = "root";
$db_pass = "root";
$db_name = "causehub";

mysql_connect("$db_host","$db_username","$db_pass") or die ("Could not connect to MySQL");
mysql_select_db("$db_name") or die ("No Database");
?>
