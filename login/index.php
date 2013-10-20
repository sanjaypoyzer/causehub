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
          Password: <input type="password" id='p' name="passwort" size="15" /><br />
        <div align="center">
        <p><input type="submit" id='signinbtn' value="Login" onclick='login(); return false;'/></p>
        </div>
    </form>
    </main>
</body>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script><script src="/scripts/extra.js"></script>
    <script src="/scripts/login.js"></script>
    <script src="/plugins/alertify/alertify.js"></script>
    <script src="/plugins/nprogress/nprogress.js"></script>
</html>
