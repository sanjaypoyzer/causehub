<?php
function checkSession() {
    $sessionid = $_SESSION['id'];
    $ip = $_SERVER['REMOTE_ADDR'];

    if ($sessionid == '') {
        return false;
    }

    $sql = mysql_query("SELECT * FROM sessions WHERE sid='$sessionid' AND killed='0'");
    $sessioncheck = mysql_num_rows($sql);

    if ($sessioncheck != 0) {
        return true;
    } else {
        $_SESSION['id'] = '';
        return false;
    }
}

function getCurrentUserInfo($type){
        if($type=='id'){
            /*$sid = $_SESSION['id'];
            $result = mysql_query("SELECT uid FROM sessions WHERE sessionid='$sid'");
            $row = mysql_fetch_row($result);
            return $row[0];
             */
             return '1';
        } else {
            $userid = getCurrentUserInfo('id');
            if($userid!=''){
            $result = mysql_query("SELECT ".$type." FROM users WHERE id='$userid'");
            $row = mysql_fetch_row($result);
            return $row[0];
            }
        }
    }
?>