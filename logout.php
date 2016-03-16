<?php

include_once('functions.php');
  unset($_SESSION['id']); // разрегистрировали переменную

  session_destroy(); // разрушаем сессию

			header("HTTP/1.1 301 Moved Permanently");
			header("Location: http://domen1.dev/login.php");
			exit();
?>  