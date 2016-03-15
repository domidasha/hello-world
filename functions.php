<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "root";
$dbName = "twitter";
$dbCon = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
  }


function validate_login_field($login){ 
	$error = array();
    if (empty($login)) {
    	$error[] = 'Enter login';
    }
    else if (iconv_strlen($login)<3) {
    	$error[] = 'Login is too short';
    }
    else if (iconv_strlen($login)>100) {
    	$error[] = 'Login is too long';
    }

    return $error;
}


function validate_password_field($password){ 
	$error = array();
    if (empty($password)) {
    	$error[] = 'Enter password';
    }
    else if (iconv_strlen($password)<3) {
    	$error[] = 'Password is too short';
    }
    else if (iconv_strlen($password)>100) {
    	$error[] = 'Password is too long';
    }
    return $error;
}

function get_user_by_login_password($login, $password) {
	global $dbCon;
	$sql = "SELECT * FROM user WHERE password='$password' and name='$login' LIMIT 1";

	$result = mysqli_query($dbCon, $sql); 
   
    if($result->num_rows == 1) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    return null;
} 

