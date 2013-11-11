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
          <p>We're currently still in Alpha (testing) stage.<br>Sign up below if you're interested in the project, and tick the box if you're interested in being a test user.</p>
          <label>Username:</label> <input type="text" id='user' name="user" size="15" /><br />
          <label>First Name:</label> <input type="text" id='fname' name="fname" size="5" /><br /> 
          <label>Last Name:</label> <input type="text" id='lname' name="lname" size="5" /><br />
          <label>Email:</label> <input type="text" id='email' name="email" size="15" /><br />
          <label>Password:</label> <input type="password" id='pass' name="pass" size="15" /><br />
        <div align="center">
        <p><input type="submit" id='registerbtn' value="Register" onclick='register(); return false;'/></p>
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
