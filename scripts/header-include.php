    <!-- Fixed navbar -->
    <div class="navbar navbar-fixed-top" role="navigation">
          <a href="/infohub"><button class="searchbtn">Search InfoHub</button></a>

         <h1><a href="/">CauseHub.</a></h1>


          <ul class="nav navbar-nav navbar-right">
            		<?php
						if($loggedin){
							echo '<li class="loggedin">Welcome back, <a href="/dash">'.getCurrentUserInfo('fname').' '.getCurrentUserInfo('lname').'</a> | <a href="/scripts/logout.php" class="logout">Logout</a></li>';
						} else {
							echo '<li class="login"><a href="/login"><button>Login</button></a><a href="/register"><button>Register</button></a></li>';
						}
					?>
          </ul>

    </div>


<!-- 

<header>
		<a href="/infohub"><button class="searchbtn">Search InfoHub</button></a>
		<h1><a href="/">CauseHub.</a></h1>
		<?php
			if($loggedin){
				echo '<span class="loggedin">Welcome back, <a href="/dash">'.getCurrentUserInfo('fname').' '.getCurrentUserInfo('lname').'</a> | <a href="/scripts/logout.php" class="logout">Logout</a></span>';
			} else {
				echo '<span class="login"><a href="/login"><button>Login</button></a><a href="/register"><button>Register</button></a></span>';
			}
		?>
</header> -->