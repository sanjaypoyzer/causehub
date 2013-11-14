<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');

	if(checkSession()){header('location:/');}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CauseHub. | Login</title>
    <meta name="description" content="A decentralised, open-source toolkit to bring people around a common cause.">
    <meta name="keywords" content="CauseHub,Cause,Hub,Community,Common,Tool,Toolkit,Decentralised,Open-Source,World,login">
    <meta name="author" content="CauseHub">

    <link rel="stylesheet" href="/css/style.css">

    <link rel="stylesheet" href="/plugins/alertify/alertify.core.css" />
    <link rel="stylesheet" href="/plugins/alertify/alertify.default.css" />

    <link rel="stylesheet" href="/plugins/nprogress/nprogress.css" />
</head>
<body class="index">
    <header>
        <h1><a href="/">CauseHub.</a></h1>
    </header>
    <main>
    <form method='post' class='login' action='#' onsubmit="return false;">
          Username: <input type="text" id='u' name="username" size="15" /><br />
          Password: <input type="password" id='p' name="password" size="15" /><br />
        <div align="center">
        <p><input type="submit" id='signinbtn' value="Login" onclick='login(); return false;'/> <a href='forgot'>Forgot password</a></p>
        </div>
    </form>
    </main>
    <?php include ($_SERVER['DOCUMENT_ROOT'].'/scripts/feedback-include.php'); ?>
</body>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script><script src="/scripts/extra.js"></script>
    <script src="/scripts/login.js"></script>
    <script src="/plugins/alertify/alertify.js"></script>
    <script src="/plugins/nprogress/nprogress.js"></script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-45734252-1', 'causehub.co');
      ga('send', 'pageview');
    </script>
    <?php
        if($_SESSION['forgot_msg']!=''){
            $parts = explode(':', $_SESSION['forgot_msg']);
            echo '<script>';
            echo 'alertify.log("'.$parts[1].'","'.$parts[0].'");';
            echo '</script>';
            unset($_SESSION['forgot_msg']);
        }
    ?>
</html>
