<?php
 # Logout script

 //Specify a file which will be displayed after logout
 //Vyberte soubor, kter� se zobraz� po odhl�sen�
 $logoutfile="login.php";
 
 session_start();
 $_SESSION = array();
 session_destroy();
 if ($_SESSION["user_is_logged"]){
  echo "FATAL ERROR: Cannot terminate session!";
  } else {
   header("Location: ".$logoutfile);
  }
?>  
