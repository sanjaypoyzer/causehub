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
    <title>CauseHub. | Register</title>
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
          <p>We're currently still in Alpha (testing) stage.<br>During this period signups are disabled, to apply to become a test user please email<br><b>alpha@causehub.co</b></p>
          <label>Username:</label> <input type="text" id='user' name="user" size="15" disabled/><br />
          <label>First Name:</label> <input type="text" id='fname' name="fname" size="5" disabled/><br /> 
          <label>Last Name:</label> <input type="text" id='lname' name="lname" size="5" disabled/><br />
          <label>Email:</label> <input type="text" id='email' name="email" size="15" disabled/><br />
          <label>Password:</label> <input type="password" id='pass' name="pass" size="15" disabled/><br />
        <div align="center">
        <p><input type="submit" id='registerbtn' value="Register" onclick='alertify.log("We are sorry, but no user signups are allowed in this version of the Alpha", "error"); return false;'/></p>
        </div>
    </form>
    </main>
    <?php include ($_SERVER['DOCUMENT_ROOT'].'/scripts/feedback-include.php'); ?>
</body>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script><script src="/scripts/extra.js"></script>
    <script src="/scripts/register.js"></script>
    <script src="/plugins/alertify/alertify.js"></script>
    <script src="/plugins/nprogress/nprogress.js"></script>
</html>
