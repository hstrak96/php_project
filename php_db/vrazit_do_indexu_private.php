<?php

// PRAVDĚPODOBNĚ VRAZIT DO SEMINÁRKY
  if (!IsSet($nazev)) $nazev="";
  if (!IsSet($orderby)) $orderby="";
// KONEC


  require("connect.php");
?>
<HTML>
<HEAD>
<META http-equiv=Content-Type content="text/html; charset=windows-1250">
<TITLE>Evidence osob</TITLE>



</HEAD>
<BODY>
<H1>Evidence osob</H1>
Hledání podle začátku Jména<BR>





<!-- VYHLEDÁVÁNÍ - VRAZIT DO SEMINÁRKY -->
<FORM ACTION=index.php method=get>
<INPUT NAME=jmeno SIZE=11 VALUE="<?php echo $_GET[jmeno] ?>">
<INPUT TYPE=HIDDEN  NAME=orderby VALUE="<?php echo $_GET[orderby]?>">
<INPUT TYPE=SUBMIT VALUE="hledej">
</FORM>
<!-- KONEC -->





<P><A HREF="pridat.php">Přidání nové položky</A>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<IMG SRC="asc.gif" WIDTH=30 HIGHT=30>&nbsp;Seřadit vzestupně &nbsp&nbsp
<IMG SRC="desc.gif" WIDTH=30 HIGHT=30>&nbsp;Seřadit sestupně
<HR>
<?php
//30



// VRAZIT DO SEMINÁRKY - ŘAZENÍ (VZESTUPNĚ/SESTUPNĚ)
function TlacitkoProRazeni($polozka,$popis)
{
 global $Nazev;
  return
 "<A HREF='index.php?orderby=$polozka&jmeno=".
  URLEncode($_GET[jmeno])."'>". "<IMG SRC=asc.gif WIDTH=20 HEIGHT=20></A>&nbsp;".$popis."&nbsp;".
"<A HREF='index.php?orderby=$polozka+DESC&jmeno=".
URLEncode($_GET[jmeno])."'>"."<IMG SRC=desc.gif BORER=0 WIDTH=20 HEIGHT=20></A>";
}
// KONEC




// spojeni s databazi


// VRAZIT TAKY DO SEMINÁRKY
if ($_GET[jmeno]!="")
    $Podminka="WHERE jmeno LIKE '".AddSlashes($_GET[jmeno])."%'";
else
    $Podminka =" ";

if($_GET[orderby]!="")
    $Orderby = "ORDER BY $_GET[orderby]";
else
   $Orderby = "ORDER BY jmeno";
   
  $sql = "select * from osoba ".$Podminka.$Orderby;
// KONEC



// TOHLE VYMĚNIT ZA ZÁHLAVÍ TABULKY
$vysledek = mysqli_query($spojeni,$sql);
echo "<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=4>\n";
echo "<TR BGCOLOR=TEAL VALIGN=TOP>\n";
echo "<TH>".TlacitkoProRazeni("cislo","Číslo")."</TH>\n";
echo "<TH>".TlacitkoProRazeni("jmeno","Jméno")."</TH>\n";
echo "<TH>".TlacitkoProRazeni("prijmeni","Příjmení")."</TH>\n";
echo "<TH>".TlacitkoProRazeni("bydliste","Bydliště")."</TH>\n";
echo "<TH><TH>\n";
// KONEC




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
    echo "<TD  ALIGN=CENTER>".$zaznam["bydliste"]. "</TD>";

    echo "<TD ALIGN=CENTER>". "<A HREF='smazat.php?oc=$oc'>Smazat</A></TD>";

    echo "<TD ALIGN=CENTER>". "<A HREF='upravit.php?oc=$oc'>Upravit</A></TD>";
    echo "<TR VALIGN=TOP>";

    $i=$i+1;
  endwhile;
  } else {
    echo "0 nalezených záznamů";
}



  echo"</TABLE>";









mysqli_close($spojeni);
?>
  <P><A HREF="vypis.php">Výpis ze 2 tabulek</A>  <br>
    <P><A HREF="vypispdf.php">Výpis do pdf</A>  <br>

</BODY>
</HTML>