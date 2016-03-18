<?php

include_once('functions.php');
$allMessages = array();


?>


<!DOCTYPE>
<html>
<head>
<style>
	body{
		width: 680px;
		margin: 50px auto;
		background: #bbb;
	}

	a {
		text-align: center;
		display: block;
		color: #fefefe;
		font-family: Helvetica, Arial, sans-serif;
		font-size: 24px;
		margin-bottom: 20px;
	}

	a:hover {
		color: #fff;
		text-decoration: none;
	}

	.message {
		margin: 0 auto 10px;
		background: #eee;
		padding: 10px;
	}

	.date {
		font-size: 12px;
		text-align: right;
	}

</style>
</head>
<body>
<a href="login.php">Login</a>
<?php
	$allMessages = get_last_messages();
if (!empty($allMessages)) {
	foreach ($allMessages as $message) : ?>
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