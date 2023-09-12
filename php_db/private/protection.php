<?php

 //specify file, which will be included when user is not logged-in
 //Napi¹ soubor, který se zobrazí, pokud u¾ivatel nen9 pøihlá¹en
 $error_file="login.php";
 
 session_start();
 header("Cache-control: private");
 if ($_SESSION["user_is_logged"] != 1){
  header("Location: ".$error_file);
  exit();
  }
?>