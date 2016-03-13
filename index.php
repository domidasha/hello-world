<!DOCTYPE>
<html>
<head>
	<title>Form</title>

	<style type="text/css">	
	img{
		width: 200px;
		border: 1px solid #000;
	}
	</style>

</head>
<body>

	<?php
	
	if ($_SERVER['REQUEST_METHOD']=='POST') {

		//file destination	
		$uploaddir = './uploads/';
		$uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);

		// copy:
		if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile)){
			echo "<h3>all right</h3>";
		}
		else {
			echo "<h3>Error</h3>"; exit; 
		}

		//picture
		echo "<h3>Your picture: </h3>";
		echo "<img src='".$uploadfile ."'>";

		// info 
		echo "<h3>Info: </h3>";
		print_r($_FILES);
	}

	if ($_SERVER['REQUEST_METHOD']=='GET') {
		?>
	<form action="index.php" method="post" enctype="multipart/form-data">
	    Select image to upload:
		<input type="file" name="uploadfile">
		<input type="submit" value="Submit">
	</form>
	<?php
	}
	?>
</body>
</html>
