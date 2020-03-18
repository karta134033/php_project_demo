<?php
	require $_SERVER['DOCUMENT_ROOT']."/Demo/Include/head.php";
	require $_SERVER['DOCUMENT_ROOT']."/Demo/Nav/nav.php";
?>
<div class="container">
	<div class="wrapper">
		<form action="login.php" method="post" name="Login_Form" class="form-signin" method="post">       
				<h3 class="form-signin-heading">Login</h3>
				
				<input type="text" class="form-control" name="Username" placeholder="Username" required="" autofocus="" />
				<input type="password" class="form-control" name="Password" placeholder="Password" required=""/>     		  
				
				<button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">登入</button>  			
		</form>			
	</div>
</div>
	