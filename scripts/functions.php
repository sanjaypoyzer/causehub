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

function getCurrentUserInfo($type) {
    if ($type == 'id') {
        $sid = $_SESSION['id'];
        $result = mysql_query("SELECT uid FROM sessions WHERE sid='$sid' AND killed='0'");
        $row = mysql_fetch_row($result);
        return $row[0];
    } else {
        $userid = getCurrentUserInfo('id');
        if ($userid != '') {
            $result = mysql_query("SELECT " . $type . " FROM users WHERE id='$userid'");
            $row = mysql_fetch_row($result);
            return $row[0];
        }
    }
}



/// Tracking

    if(checkSession()){
        if (strpos($_SERVER["REQUEST_URI"],'scripts') !== false) {
        } else {
            $sessionid = $_SESSION['id'];
            $nextpathitem = count($_SESSION['path']);
            $prevpathitem = count($_SESSION['path'])-1;
            if($_SERVER["REQUEST_URI"] != $_SESSION['path'][$prevpathitem]['uri']){
                $_SESSION['path'][$nextpathitem]['uri'] = $_SERVER["REQUEST_URI"];
                $_SESSION['path'][$nextpathitem]['timedate'] = date("Y-m-d")." ".strftime("%H:%M:%S");
                $path_string = mysql_real_escape_string(serialize($_SESSION['path']));
                mysql_query("UPDATE sessions SET path='$path_string' WHERE sid='$sessionid'");
            }
        }
    }
?>