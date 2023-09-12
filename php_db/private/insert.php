<?php
require("../connect.php");
require 'protection.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
 <head>
   <title>Hráč přidán</title>
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-2"/>
   <link rel="stylesheet" type="text/css" href="../../css/style.css" />
   <style type="text/css">
   	    body{
      background-color: #f9f9fb;
      padding: 0;
      margin: 0;
      font-family: Helvetica;
    }

    .stranka{
      width: 70%;
      margin: auto;
      margin-top: 20px;
      position: relative;
      
    }

    .hlavicka{
      /*top: 0;*/
      /*text-align: center;*/
      width: 100%;
      height: 30px;
      margin: auto;
      padding-top: 15px;
      background-color: #57b847;
      color: white;
      font-weight: bold;
    }

    .paticka{
      position: fixed;
      bottom: 0;
      text-align: center;
      width: 100%;
      background-color: #57b847;
      color: white;
    }

    .hlavicka2{
      width: 70%;
      margin: auto;
      margin-top: -2px;
    }

    .nazev{
      position: relative;
      width: 50%;
      float: left;
    }

    .udaje{
      position: relative;
      width: 50%;
      float: right;
      text-align: right;
    }

    .prihlaseny{
      font-weight: normal;
    }

    .jmeno{
      float: left;
      width: 80%;
    }

    .logout{
      float: right;
      font-weight: normal;
      width: 20%;
      text-align: center;
    }

    .odhlaseni {
      padding: 8px 15px;
      border-radius: 6px;
      background-color: #f44336;
      color: white;
      text-align: center;
      text-decoration: none;
      /*border: 3px solid #f44336;*/
      -webkit-transition: 0.5s;
      transition: 0.5s;

    }

    .odhlaseni:hover{
      background-color: #d4281c;
    }
   </style>
 </head>

<body>
  <div class="hlavicka">
    <div class="hlavicka2">
      <div class="nazev">
        TIS - závěrečná práce - Evidence hráčů
      </div>
      <div class="udaje">
        <div class="jmeno">
          <span class="prihlaseny">Jste přihlášený jako:</span>
          <span>
          <?php 
            echo $_SESSION["login"]; 
          ?>
          </span> 
        </div>  
        <div class="logout">
          <a href="./../logout.php" class="odhlaseni">Odhlásit</a>        
        </div>
      </div>
    </div>
  </div>
  <div class="stranka">

<?php
if($_SESSION["login"]=='admin')
{
	$sql = "INSERT INTO hrac (cislo, jmeno, prijmeni, tym) values('$_GET[cislo]','$_GET[jmeno]','$_GET[prijmeni]', '$_GET[tym]')";

	     

	if (mysqli_query($spojeni, $sql)) {
	    echo "Záznam byl úspešně přidán";
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($spojeni);
	}
	mysqli_close($spojeni);
}
?>


	<BR>
	<A HREF="index.php">Prohlíženi všech hráčů</A>

	</stranka>
  </div>
  <div class="paticka">
    <p>&copy; Jan Straka 2020</p>
  </div>
 </body>
</html>




