<!DOCTYPE>
<html>
<head>
	<meta charset="unt-8">
	<title>Form</title>
</head>
<body>
	<?php

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		print_r($_FILES);
	}
	if ($_SERVER['REQUEST_METHOD']=='GET') {
		?>
		<form action="<?php $SERVER['PHPSELF']; ?>" method="POST" enctype="multipart/form-data">
			Press Button: <br>
			<input type="file" name="pic">
			<input type="submit"	value="Submit">
		</form>
		<?php
	}

	?>
</body>
</html>
