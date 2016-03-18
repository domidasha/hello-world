<?php

include_once('functions.php');
$errorMessage = array();
$errorImage = array();
$message=array();
$userMessagesArray=array();


	$user = getCurrentUser();
	if ($user==null) {
		redirect('index.php');
	} 

	echo $_SESSION['id'];
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		
		$errorMessage = validate_message_field($_POST['message']);
	
		if (isset($_FILES['uploaded'])  && !empty($_FILES['uploaded']['name'])) {
			//$fileArray= $_FILES['uploaded'];

			$errorImage = validate_uploaded_file($_FILES['uploaded']);
			
		}	

		if (empty($errorMessage) and empty($errorImage)) {
			//print_r($_FILES['uploaded']);
			
			if (empty($_FILES['uploaded']['name'])) {
				$message["image_path"] = '';
			} else {
				save_uploaded_image($_FILES['uploaded']);
				$message["image_path"] = './images/'.$_FILES['uploaded']['name'];
			}			

			$message["text"] = $_POST['message'];			
			$message["user_id"] = $user['id'];

			create_message($message);
			

		}
//	$myfile = $_FILES['uploadfile']['type'];

	}
?>	


<!DOCTYPE>
<html>
<head>
<title>twitts</title>

<style>
	body{
		width: 900px;
		margin: 50px auto;
		background: #bbb;
	}

	a {
		color: #fefefe;
		font-family: Helvetica, Arial, sans-serif;
	}

	a:hover {
		color: #fff;
		text-decoration: none;
	}

	.error {
		color: red;
		font-size: 12px;
	}
	
	.message {
		float: right;
		width: 460px;
		margin: 0 0 10px 20px;
		background: #eee;
		padding: 10px;
	}

	.date {
		font-size: 12px;
		text-align: right;
		font-style: italic;
	}

	form{
		float: left;
		width: 380px;
		background: #ddd;
		padding: 10px;
	}

</style>
</head>
<body>
<p>
	<a href="logout.php">Logout</a>
</p>


<form action="/twitts.php" method="POST" enctype="multipart/form-data">
	<p>Add post:</p>
	<textarea name="message"></textarea>

	<?php 
		foreach ( $errorMessage as $value ) {
			echo "<p class='error'>".$value."</p>"; 
		}
	?>

	<p>App picture:</p>
	<input type="file" name="uploaded"></input>

	<?php 
		foreach ( $errorImage as $value ) {
			echo "<p class='error'>".$value."</p>"; 
		}
	?>
	<br>
	<input type="submit" value="Submit"></input>
</form>


<?php
	$userMessagesArray = get_messages_by_user($user);
if (!empty($userMessagesArray)) {
	foreach ($userMessagesArray as $message) : ?>
		<div class="message">
			<div><?php echo $message["message"]?></div>
			<p class="date"><?php echo $message["create_at"] ?></p> 
			  <?php if(!empty($message["image_path"])) : ?> 
				<img src="<?php echo $message["image_path"] ?>"/>
				<?php endif; ?>			
		</div>
	 <?php endforeach;
}
?>




	
</body>
</html>
<?php

?>