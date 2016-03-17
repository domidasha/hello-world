<?php

include_once('functions.php');
  unset($_SESSION['id']); // разрегистрировали переменную
  session_destroy(); // разрушаем сессию
  redirect('login.php');
?>  