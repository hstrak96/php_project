<?php

 //specify file, which will be included when user is not logged-in
 //Napi� soubor, kter� se zobraz�, pokud u�ivatel nen9 p�ihl�en
 $error_file="login.php";
 
 session_start();
 header("Cache-control: private");
 if ($_SESSION["user_is_logged"] != 1){
  header("Location: ".$error_file);
  exit();
  }
?>