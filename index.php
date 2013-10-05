<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
    include($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');
    
    //if(!checkSession()){header('location:/login');}
    echo getCurrentUserInfo('id');
?>