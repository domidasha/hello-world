<!DOCTYPE>
<html>
<head>
	<meta charset="utf-8">
	<title>Данные формы</title>
</head>

<body>
	<?php

	if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
		print_r($_FILES);
		
	}
	if ($_SERVER['REQUEST_METHOD'] == 'GET' ){
		?>
			<form action = "<?=$_SERVER['PHP_SELF']?>" method = "POST" enctype="multipart/form-data">
				Нажмите на кнопку:<br>
				
				<input type="file" name="snapshot1.png">
				<input type="submit" value="submit">
			</form>

		<?php
	}


	?>

	
</body>
</html>