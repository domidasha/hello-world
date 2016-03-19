<?php
session_start();
$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "root";
$dbName = "twitter";
$dbCon = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
$imagesArray=array('jpeg', 'png', 'jpg', 'gif');


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
    $login = addslashes($login);
    $password = addslashes($password);

	$sql = "SELECT * FROM user WHERE password='$password' and name='$login' LIMIT 1";

	$result = mysqli_query($dbCon, $sql); 
   
if($result->num_rows == 1) {
        $row = mysqli_fetch_assoc($result);
        var_dump($row);
        return $row;
    }
    return null;
}

function get_user_by_id($userId) {
    global $dbCon;
    $sql = "SELECT * FROM user WHERE id = '{$userId}'";
    $result = mysqli_query($dbCon, $sql); 

    $row = mysqli_fetch_assoc($result);
    
    return $row;

} 

function setCurrentUser($user) {    
    if (is_array($user)) {
        if (array_key_exists('id', $user)) { 
            $_SESSION['id'] = $user['id'];
            } 
    }
}

function getCurrentUser() {
    if (isset($_SESSION['id'])) {
        return get_user_by_id($_SESSION['id']);
    }

    return null;    
}


function validate_message_field($message){ 
    $error = array();
    if (empty($message)) {
        $error[] = 'Write your message';
    }
    else if (iconv_strlen($message)>140) {
        $error[] = 'Message is too long';
    }

    return $error;
}

function redirect($address) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: http://domen1.dev/".$address);  ///!!
    exit();
}


function validate_uploaded_file($uploadedFile) {
    global  $imagesArray;
    $error = array();
    $isImg = false;
    
   // print_r(array_key_exists('size', $uploadedFile));

    $type = substr($uploadedFile['type'], 6);
  //  print_r($type);

    foreach ($imagesArray as $imgType) {
        if ($imgType == $type) {
           $isImg = true; 
        }        
    }
    if ($isImg == false) {
        $error[] = "the wrong file type! please load image. "; 
    }
    if ($uploadedFile['size']>100000) {
       $error[] = "File is too big";
      }

    return $error;
}

function save_uploaded_image($file) {

    $uploaddir = './images/';
    $uploadfile = $uploaddir.basename($file['name']);
    copy($file['tmp_name'], $uploadfile);

    // if (copy($file['tmp_name'], $uploadfile)){
    //     echo "<img src='".$uploadfile ."'><br>";
    // }    
}


function create_message($message) {
    global $dbCon;

    $string0 = $message['user_id'];
    $string1 = addslashes($message['text']);
    $string2 = $message['image_path'];


    $sql = sprintf("INSERT INTO twitts (user_id, message,image_path) VALUES ('%s', '%s', '%s')", $string0, $string1, $string2);

   // print_r($sql);
    $result = mysqli_query($dbCon, $sql); 
}

function get_messages_by_user($user) {
    global $dbCon;
    $userMessagesArray = array();
    
    $string = $user['id'];

    $sql = sprintf("SELECT id, message, image_path, create_at from twitts where user_id = '%s' ORDER BY create_at DESC", $string);
    $result = mysqli_query ($dbCon, $sql); 

    while($row = mysqli_fetch_assoc($result)){
        $userMessagesArray[] = $row;
    }

    return $userMessagesArray;
}

function get_last_messages() {
    global $dbCon;
    $userMessagesArray = array();

    $sql = sprintf("SELECT message, image_path, create_at from twitts order by rand() limit 10");
    $result = mysqli_query ($dbCon, $sql); 

    while($row = mysqli_fetch_assoc($result)){
        $userMessagesArray[] = $row;
    }

    return $userMessagesArray;
}

function clean_table ($user) { 
    global $dbCon;
    $userMessagesArray = array();
    
    $string = $user['id'];

    $sql = sprintf("DELETE FROM twitts WHERE user_id = '%s'", $string);
    $result = mysqli_query ($dbCon, $sql); 
}