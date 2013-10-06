<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');

	if(checkSession()){$loggedin = true;} else {$loggedin = false;}

	$slug = $_GET['slug'];
	$sql = mysql_query("SELECT id,name,description FROM kb_action_petitions WHERE slug='$slug'");
	$logincheck = mysql_num_rows($sql);
	$pagefound = false;
	if($logincheck!=0){
		$pagefound = true;
	}
	
	$row = mysql_fetch_array($sql);
	$petitionid = $row['id'];
	$petitionname = $row['name'];
	$petitiondescription = $row['description'];


	if(!$pagefound){
		echo 'Cause not found';
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>CauseHub. | <?php echo $petitionname; ?></title>
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  <script src="/scripts/editcause_updateformactions.js"></script>
  <script src="/plugins/alertify/alertify.js"></script>
  <link rel="stylesheet" href="/plugins/alertify/alertify.core.css" />
  <link rel="stylesheet" href="/plugins/alertify/alertify.default.css" />
</head>
<body>
<header>
	<h1>CauseHub.</h1>
	<?php
		if($loggedin){
			echo '<span class="loggedin">Welcome back, <a href="/dash">'.getCurrentUserInfo('fname').' '.getCurrentUserInfo('lname').'</a> | <a href="/scripts/logout.php" class="logout">Logout</a></span>';
		} else {
			echo '<span class="login"><a href="/login"><button>Login</button></a><a href="/signup"><button>Signup</button></a></span>';
		}
	?>
</header>
<main class="edit">
	<h1>Petition title</h1>
	<h2>Sign This Petition:</h2>
		<form method='post' action='#' onsubmit="return false;">
		  First Name: <input type="text" name="fname" size="15" /><br />
		  Last Name: <input type="text" name="lname" size="15" /><br />
		  Email: <input type="email" name="email" size="15" /><br />
		  <input type="checkbox" name="public" value="Public">Display my name publically<br>
		  <input type='submit' id='addsignaturebtn' value='Add Signature' onclick='addsignature(); return false;'>
		</form>
	<h2>Public Names</h2>
	<ul>
		<li>barry the dicktivist</li>
	</ul>
</main>
</body>
</html>
