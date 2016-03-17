<?php

include_once('functions.php');
$errorMessage = array();
$errorImage = array();
$message=array();
$userMessagesArray=array();


	$user = getCurrentUser();
	if ($user==null) {
		redirect('login.php');
	} 


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
	}
	.error {
		color: red;
		font-size: 12px;
	}
	.message {
		float: right;
		width: 50%;
		margin: 10px;
		background: #eee;
		padding: 20px;
	}

	.date {
		font-size: 12px;
		text-align: right;
	}

	form{
		float: left;
	}

</style>
</head>
<body>
<a href="logout.php">Logout</a>


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

	<input type="submit" value="Submit"></input>
</form>


<?php
	$userMessagesArray = get_messages_by_user($user);
if (!empty($userMessagesArray)) {
	foreach ($userMessagesArray as $message) : ?>
		<div class="message">
			<div><?php echo $message["message"]?></div>
			<p class="date"><?php echo $message["create_at"] ?></p> 
			<!-- <?php if($message["image_path"]==) {

			}

			?>
			<img src="<?php echo $message["image_path"] ?>"/>
 -->
		</div>
	 <?php endforeach;
}

?>




	
</body>
</html>
<?php

?>