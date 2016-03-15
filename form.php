<!DOCTYPE>
<html>
<head>
	<title>Form</title>
</head>
<body>

	<?php
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		//print_r($_FILES);
		$myfile = $_FILES['uploadfile']['type'];
		if ($myfile=='') {
			$url_orderpage="http://domen1.dev/index.php";
 			fopen($url_orderpage,"r");
			echo '<p>Please load your image</p>';
		} if ($myfile=='image/jpeg' || $myfile=='image/jpg' ) {
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
		}  
		else {
			echo '<p>Please load IMG, not '.$myfile.'!</p>';
		}
	}
	?>
	
	<form action="index.php" method="post" enctype="multipart/form-data">
	    Select image to upload:
		<input type="file" name="uploadfile">
		<input type="submit" value="Submit">
	</form>
	
</body>
</html>
