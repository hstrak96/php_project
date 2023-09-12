<?php

 if (isset($_GET['action']))
 {
  require("connect.php");
  $user=$_POST['user'];
  $pass=md5($_POST['passwd']);
  //echo "zasifrovane heslo je ".$pass; 
  $sql = "select * from users where login='$user' AND password='$pass' ";         
  $vysledek = mysqli_query($spojeni, $sql);

    //echo "pocet zaznamu je ".mysqli_num_rows($vysledek);
    if ( mysqli_num_rows($vysledek)>0 )
    {
      $zaznam = mysqli_fetch_assoc($vysledek);
      session_start();
      header("Cache-control: private");
      $_SESSION["user_is_logged"] = 1;
      $_SESSION["role"] = $zaznam['role'] ;
      $_SESSION["login"] = $zaznam['login'] ;
     //cho "login je ".$_SESSION["login"];  
    //ho "role je ".$_SESSION["role"]; 
      header("Location: private/index.php");
      exit;
    }
  }                                                              
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
 <head>
   <!--<title><?php //echo $auth; ?></title>-->
   <title>Seminární práce</title>
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-2"/>
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
      text-align: center;
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

    .udaje {
        border-spacing: 0;
    }
    .login {
        border: 1px solid #000;
        padding: 0.5em 1em;
    }

    th{
      color: white;
    }

    thead tr:first-child th:first-child {
        border-radius: 0.6em 0 0 0;
        background-color: #57b847;
    }
    thead tr:first-child th:last-child {
        border-radius: 0 0.6em 0 0;
      background-color: #57b847;
    }
    tbody tr:last-child td:first-child {
        border-radius: 0 0 0 0.6em;
    }
    tbody tr:last-child td:last-child {
        border-radius: 0 0 0.6em 0;
    }
    .uzivatel:hover{
      /*background-color: #8ebe79;*/
      background-color: #ccd0cb;
    }

    .uvod{
      margin-bottom: 50px;
      overflow: auto;
    }

    .tabulka{
      width: 233px;
      margin: auto;

    }



    /* přihlašeovací formulář */
    .prihlasovani{
      margin: auto;
      width: 400px;
      border-radius: 20px;
      height: 300px;
      -webkit-box-shadow: 0px 0px 15px 1px rgba(0,0,0,0.3);
      -moz-box-shadow: 0px 0px 15px 1px rgba(0,0,0,0.3);
      box-shadow: 0px 0px 15px 1px rgba(0,0,0,0.3);

    }

    .horni_pruh{
      border-radius: 20px 20px 0 0;
      height: 50px;
      width: 400px;
      background-color: #57b847;    
      text-align: center;
      display: table-cell;
      vertical-align: middle;
      color: white;
      font-weight: 600;
      font-size: 20px;
    }

    form{
      text-align: center;
    }

    .username{
      border: 3px solid #ccc;
      -webkit-transition: 0.5s;
      transition: 0.5s;
      outline: none;
      height: 30px;
      width: 65%;
      margin-top: 30px;
      border-radius: 10px;
      text-align: center;
    }

    .password{
      border: 3px solid #ccc;
      -webkit-transition: 0.5s;
      transition: 0.5s;
      outline: none;
      height: 30px;
      width: 65%;
      margin-top: 15px;
      border-radius: 10px;
      text-align: center;
    }

    input[type=text]:focus {
      border: 3px solid #57b847;
    }

    input[type=password]:focus {
      border: 3px solid #57b847;
    }

    .reset{
      margin-top: 5px;
      float: right;
      margin-right: 16.5%;
      border: none;
      background-color: #f9f9fb;
      font-weight: bold;
      color: #57b847;
    }

    .submit{
      /*border: 3px solid #ccc;*/
      border: none;
      height: 40px;
      width: 66.5%;
      margin-top: 30px;
      border-radius: 10px;
      text-align: center;
      background-color: #57b847;
      font-weight: bold;
    }

    .submit:hover{
      border: 3px solid #ccc;
    }
  </style>
 </head>

<body> 
  <div class="hlavicka">
      TIS - závěrečná práce - Evidence hráčů
    </div>
  <div class="stranka">
    <div class="uvod">

      <h2>Evidence hráčů</h2>
      <p>Stránky slouží k evidenci hráčů fotbalových klubů. Uživatelé mohou procházet seznam hráčů, vyhledávat v něm, řadit hřáče
          dle vybraných kritérií jako je jméno, příjmení nebo klub, za který hrají.</p>
      <p>V tabulce naleznete uživatelská jména a hesla, kterými se můžete přihlásit:</p>
      <div class="tabulka">
        <table class="udaje">
          <thead>
            <tr>
              <th class="login">Uživatelské jméno</th>
              <th class="login">Heslo</th>
            </tr>
          </thead>
          <tbody>
            <tr class="uzivatel">
              <td class="login">admin</td>
              <td class="login">admin</td>
            </tr>
            <tr class="uzivatel"> 
              <td class="login">user</td>
              <td class="login">user</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="prihlasovani">
      <div class="horni_pruh">
        Přihlášení
      </div>
        <form action="./login.php?action=validate" method="post">
          <input type="text" name="user" placeholder="Uživatelské jméno" class="username" /><br>
          <input type="password" name="passwd" placeholder="Heslo" class="password" /><br>
            <input type="reset" value="Zrušit" class="reset" /><br><br>     
            <input type="submit" value="PŘIHLÁSIT"  class="submit" /><br>
        </form>
      </div>      
    </div>
    
  </div>
  <div class="paticka">
      <p>&copy; Jan Straka 2020</p>
  </div>



  <!--
  <div id="container">
    <p>
    Přihlašovací údaje:<br>
    <br>
    administrátor:<br>
    login: admin<br>
    heslo: admin<br>
    <br>
    uživatel:<br>
    login: user<br>
    heslo: user<br>
    </p>

  <form action="./login.php?action=validate" method="post">
   <table>
    <tr><td>Jméno: </td><td><input type="text" name="user" /></td></tr>
    <tr><td>Heslo: </td><td><input type="password" name="passwd" /></td></tr>
    <tr><td colspan="2"><input type="submit" value="ok" />
    <input type="reset" value="Storno" /></td></tr>
   </table>
  </form>
  <hr />

  </div>
-->
 </body>
</html>
