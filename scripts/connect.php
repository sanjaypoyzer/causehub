<?php
 $db_host = "localhost";
 $db_username = "causehub_user";
 $db_pass = "causehub_password";
 $db_name = "causehub_causehub";
 
 mysql_connect("$db_host","$db_username","$db_pass") or die ("Could not connect to MySQL");
 mysql_select_db("$db_name") or die ("No Database");
?>
