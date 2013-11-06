<?php
  session_start();
  include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
  include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');

  if(checkSession()){$loggedin = true;} else {$loggedin = false;}

  $causeidpost = $_GET['cid'];
  $sql = mysql_query("SELECT id,uid,name,slug,banner,description,hidden FROM causes WHERE id='$causeidpost' AND deleted='0'");
  $row = mysql_fetch_array($sql);
  $causeid = $row['id'];
  $ownerid = $row['uid'];
  $causename = $row['name'];
  $causebanner = $row['banner'];
  $causedescription = $row['description'];
  $causestart = $row['started'];
  $causehidden = $row['hidden'];
  $causeslug = $row['slug'];

  if($causename==''){
    header('location:/?'.$causeidpost);
    exit;
  } else if($ownerid!=getCurrentUserInfo('id')){
    header('location:/cause/'.$causeslug.'/');
    exit;
  }

  $allowedExts = array("gif", "jpeg", "jpg", "png");
  $temp = explode(".", $_FILES["file"]["name"]);
  $extension = end($temp);
  if ((($_FILES["file"]["type"] == "image/gif")
  || ($_FILES["file"]["type"] == "image/jpeg")
  || ($_FILES["file"]["type"] == "image/jpg")
  || ($_FILES["file"]["type"] == "image/pjpeg")
  || ($_FILES["file"]["type"] == "image/x-png")
  || ($_FILES["file"]["type"] == "image/png"))
  && ($_FILES["file"]["size"] < 524288)
  && in_array($extension, $allowedExts))
    {
    if ($_FILES["file"]["error"] > 0)
      {
      $_SESSION['upload_msg'] = 'error:Upload error; '.$_FILES["file"]["error"];
      header('location:/editcause/'.$causeslug.'/');
      exit;
      } else {
          function str_rand($length = 8, $seeds = 'alphanum'){
            $seedings['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
            $seedings['numeric'] = '0123456789';
            $seedings['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';
            $seedings['hexidec'] = '0123456789abcdef';
            if (isset($seedings[$seeds])){$seeds = $seedings[$seeds];}
            list($usec, $sec) = explode(' ', microtime());
            $seed = (float) $sec + ((float) $usec * 100000);
            mt_srand($seed);
            $str = '';
            $seeds_count = strlen($seeds);
            for ($i = 0; $length > $i; $i++){$str .= $seeds{mt_rand(0, $seeds_count - 1)};}
            return $str;
          }
        $filename = str_rand(10, 'alphanum');
        move_uploaded_file($_FILES["file"]["tmp_name"], "../../usercontent/causebanners/".$filename.".".$extension);
        $newbanner = $filename.".".$extension;
        mysql_query("UPDATE causes SET banner='$newbanner' WHERE (id='$causeidpost')");
        header('location:/cause/'.$causeslug.'/');
        exit;
    }
  } else {
    $_SESSION['upload_msg'] = 'error:Invalid file, you file needs to be either a (gif, jpg, jpeg or png) and under 500 KB';
    header('location:/editcause/'.$causeslug.'/');
    exit;
  }
?>