<?php

include_once('functions.php');

	$user = getCurrentUser();
	if ($user==null) {
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: http://domen1.dev/login.php");
		exit();
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
</style>
</head>
<body>
<a href="logout.php">Logout</a>
<form action="twitts.php" method="POST">
<p>Add post:</p>
<textarea></textarea>
<p>App picture:</p>
<input type="file" name="uploaded"></input>
<input type="submit" name="submit"></input>
</form>


	<?php
	// while 
	// 	getPost();
	// $myPost= "<div>"
?>
	
</body>
</html>
<?php

?>