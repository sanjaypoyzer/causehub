<header>
		<a href="/infohub"><button class="searchbtn">Search InfoHub</button></a>
		<h1><a href="/">CauseHub.</a></h1>
		<?php
			if(checkAdmin()){
				$adminextra = ' | <a href="#" class="admin">Admin Panel</a> ';
			} else {
				$adminextra = '';
			}
			if($loggedin){
				echo '<span class="loggedin">Welcome back, <a href="/dash">'.getCurrentUserInfo('fname').' '.getCurrentUserInfo('lname').'</a> '.$adminextra.'| <a href="/scripts/logout.php" class="logout">Logout</a></span>';
			} else {
				echo '<span class="login"><a href="/login"><button>Login</button></a><a href="/register"><button>Register</button></a></span>';
			}
		?>
</header>