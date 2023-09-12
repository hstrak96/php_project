<?php
if (!IsSet($nazev)) $nazev="";
if (!IsSet($orderby)) $orderby="";

require 'protection.php';
require '../connect.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
 <head>
   <title>Evidence hráčů</title>
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

    .hledani{
      float: left;
    }

    .pridat{
      padding: 6px 10px;
      border-radius: 6px;
      background-color: #57b847;
      color: white;
      text-align: center;
      text-decoration: none;
      margin: 10px;
      border: 3px solid #57b847;
      -webkit-transition: 0.5s;
      transition: 0.5s;
    }

    .pridat:hover{
      border: 3px solid #ccc;
    }

    .novy{
      margin-bottom: 5px;
    }

    .tabulka{
      width: 90%;
      margin: auto;
    }

    td, th{
      vertical-align: middle;
    }
    .smazat:link, .smazat:visited {
      background-color: #f44336;
      color: white;
      padding: 5px 15px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      margin-right: -20px;
    }

    .smazat:hover, .smazat:active {
      background-color: red;
    }

    .upravit:link, .upravit:visited {
      background-color: #57b847;
      color: white;
      padding: 5px 15px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      margin-left: -20px;
    }

    .upravit:hover, .upravit:active {
      background-color: green;
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
?>
  <H1>Evidence hráčů</H1>

<!-- VYHLEDÁVÁNÍ - VRAZIT DO SEMINÁRKY -->
<FORM ACTION=index.php method=get class="hledani">
<INPUT NAME=jmeno SIZE=11 VALUE="<?php echo $_GET[jmeno] ?>">
<INPUT TYPE=HIDDEN  NAME=orderby VALUE="<?php echo $_GET[orderby]?>">
<INPUT TYPE=SUBMIT VALUE="hledej">
</FORM>
<!-- KONEC -->
<div class="novy">
  <A HREF="pridat.php" class="pridat">Přidání nového hráče</A>
</div>
<hr style="margin-top: 20px">
<?php

// VRAZIT DO SEMINÁRKY - ŘAZENÍ (VZESTUPNĚ/SESTUPNĚ)
function TlacitkoProRazeni($polozka,$zeme)
{
 global $Nazev;
  return
 "<A HREF='index.php?orderby=$polozka&jmeno=".
  URLEncode($_GET[jmeno])."'>". "<IMG SRC=up.png WIDTH=20 HEIGHT=20></A>&nbsp;".$zeme."&nbsp;".
"<A HREF='index.php?orderby=$polozka+DESC&jmeno=".
URLEncode($_GET[jmeno])."'>"."<IMG SRC=down.png BORER=0 WIDTH=20 HEIGHT=20></A>";
}
// KONEC

if ($_GET[jmeno]!="")
  $Podminka="WHERE jmeno LIKE '".AddSlashes($_GET[jmeno])."%'";
else
  $Podminka =" ";

if($_GET[orderby]!="")
  $Orderby = "ORDER BY $_GET[orderby]";
else
  $Orderby = "ORDER BY jmeno";
  
  $sql = "select * from hrac ".$Podminka.$Orderby;
  $vysledek = mysqli_query($spojeni,$sql);
     
$i=0;
// zahlavi tabulky pro vysledky

echo "<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=4 CLASS=tabulka>\n";
echo "<TR BGCOLOR=#57b847 VALIGN=TOP>\n";
echo "<TH>".TlacitkoProRazeni("cislo","Číslo")."</TH>\n";
echo "<TH>".TlacitkoProRazeni("jmeno","Jméno")."</TH>\n";
echo "<TH>".TlacitkoProRazeni("prijmeni","Příjmení")."</TH>\n";
echo "<TH>".TlacitkoProRazeni("tym","Tým")."</TH>\n";
echo "<TH colspan='2'>Akce</TH></TR>\n";

if (mysqli_num_rows($vysledek) > 0) 
{

 while ($zaznam = mysqli_fetch_assoc($vysledek)):

if (($i%2)==1)    // sude aliche radky maji jinou platnost
     echo "<TR VALIGN=TOP BGCOLOR=SILVER>";
else
      echo "<TR VALIGN=TOP>";
          
$oc=$zaznam["cislo"];
echo "<TD  ALIGN=CENTER>".$zaznam["cislo"]. "</TD>";
echo "<TD  ALIGN=CENTER>".$zaznam["jmeno"]. "</TD>";
echo "<TD  ALIGN=CENTER>".$zaznam["prijmeni"]. "</TD>";
echo "<TD  ALIGN=CENTER>".$zaznam["tym"]. "</TD>";

echo "<TD ALIGN=CENTER>". "<A HREF='smazat.php?oc=$oc' CLASS=smazat>Smazat</A></TD>";

echo "<TD ALIGN=CENTER>". "<A HREF='upravit.php?oc=$oc' CLASS=upravit>Upravit</A></TD>";
echo "<TR VALIGN=TOP>";

$i=$i+1;
endwhile;
   } else {
    echo "0 nalezených záznamů";
}



  echo"</TABLE>";

mysqli_close($spojeni);
?>

<?php
  }
?>


  <?php
  if($_SESSION["login"]=='user')
  {
  ?>

  <H1>Evidence hráčů</H1>



<!-- VYHLEDÁVÁNÍ - VRAZIT DO SEMINÁRKY -->
<FORM ACTION=index.php method=get class="hledani">
<INPUT NAME=jmeno SIZE=11 VALUE="<?php echo $_GET[jmeno] ?>">
<INPUT TYPE=HIDDEN  NAME=orderby VALUE="<?php echo $_GET[orderby]?>">
<INPUT TYPE=SUBMIT VALUE="hledej">
</FORM><br>
<!-- KONEC -->
<hr style="margin-top: 20px">
<?php

// VRAZIT DO SEMINÁRKY - ŘAZENÍ (VZESTUPNĚ/SESTUPNĚ)
function TlacitkoProRazeni($polozka,$zeme)
{
 global $Nazev;
  return
 "<A HREF='index.php?orderby=$polozka&jmeno=".
  URLEncode($_GET[jmeno])."'>". "<IMG SRC=up.png WIDTH=20 HEIGHT=20></A>&nbsp;".$zeme."&nbsp;".
"<A HREF='index.php?orderby=$polozka+DESC&jmeno=".
URLEncode($_GET[jmeno])."'>"."<IMG SRC=down.png BORER=0 WIDTH=20 HEIGHT=20></A>";
}
// KONEC

if ($_GET[jmeno]!="")
  $Podminka="WHERE jmeno LIKE '".AddSlashes($_GET[jmeno])."%'";
else
  $Podminka =" ";

if($_GET[orderby]!="")
  $Orderby = "ORDER BY $_GET[orderby]";
else
  $Orderby = "ORDER BY jmeno";
  
  $sql = "select * from hrac ".$Podminka.$Orderby;
  $vysledek = mysqli_query($spojeni,$sql);
     
$i=0;
// zahlavi tabulky pro vysledky

echo "<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=4 CLASS=tabulka>\n";
echo "<TR BGCOLOR=#57b847 VALIGN=TOP>\n";
echo "<TH>".TlacitkoProRazeni("cislo","Číslo")."</TH>\n";
echo "<TH>".TlacitkoProRazeni("jmeno","Jméno")."</TH>\n";
echo "<TH>".TlacitkoProRazeni("prijmeni","Příjmení")."</TH>\n";
echo "<TH>".TlacitkoProRazeni("tym","Tým")."</TH></TR>\n";

if (mysqli_num_rows($vysledek) > 0) 
{

 while ($zaznam = mysqli_fetch_assoc($vysledek)):

if (($i%2)==1)    // sude aliche radky maji jinou platnost
     echo "<TR VALIGN=TOP BGCOLOR=SILVER>";
else
      echo "<TR VALIGN=TOP>";
          
$oc=$zaznam["cislo"];
echo "<TD  ALIGN=CENTER>".$zaznam["cislo"]. "</TD>";
echo "<TD  ALIGN=CENTER>".$zaznam["jmeno"]. "</TD>";
echo "<TD  ALIGN=CENTER>".$zaznam["prijmeni"]. "</TD>";
echo "<TD  ALIGN=CENTER>".$zaznam["tym"]. "</TD>";
echo "<TR VALIGN=TOP>";

$i=$i+1;
endwhile;
   } else {
    echo "0 nalezených záznamů";
}



  echo"</TABLE>";


mysqli_close($spojeni);
?>
<?php
  }
?>

  </div>
  <div class="paticka">
    <p>&copy; Jan Straka 2020</p>
  </div>
 </body>
</html>