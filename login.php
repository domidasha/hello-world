
<?php

include_once('functions.php');
$loginErrors = array();
$passwordErrors = array();

 if (count($_POST) >0):?>

<?php	

	


	$loginErrors = validate_login_field($_POST['login']);
	$passwordErrors = validate_password_field($_POST['password']);

	if (count($loginErrors)==0 && count($passwordErrors)==0) { 
		$user = get_user_by_login_password($_POST['login'], $_POST['password']);
		
		
		if(is_null($user)){
			$loginErrors[] = "user not exists.";
		} else {
			setCurrentUser($user);
			redirect('twitts.php');
		}

	}
?>


<?php endif; ?>


<!DOCTYPE>
<html>
<head>
<title>log in</title>

<style>
	.error {
		font-size: 12px;
		color: red;
	}
	body{
		width: 680px;
		margin: 50px auto;
		background: #bbb;

	}	
	.form {
		background: #eee;
		color: #111;
		font-family: Helvetica, Arial, sans-serif;
		font-size: 18px;
		padding: 10px;
		text-align: center;
	}


</style>
</head>
<body>
	<form action="/login.php" method="post" enctype="multipart/form-data" class="form">	    
		<p>Enter login and password:</p>
	
		<p>Login:<input type="text" name="login">		
		<?php if(count($loginErrors)>0): ?>
			<span class="error">
				<?php 
					foreach ( $loginErrors as $value ) {
						 echo $value."<br>"; 
					}
				?>
			</span>
		<?php endif; ?>	
		</p>


		<p>Password:<input type="password" name="password">
		<?php if(count($passwordErrors)>0): ?>
			<span class="error">
				<?php 
					foreach ( $passwordErrors as $value ) {
						 echo $value."<br>"; 
					}
				?>
			</span>
		<?php endif; ?>
		</p>

		<input type="submit" value="Ok" />
	</form>
</body>
</html>