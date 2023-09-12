<?php
require 'protection.php';
require '../connect.php';
?>

<HTML>
<HEAD>
<TITLE>Potvrzení smazání</TITLE>
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
	
	.paticka{
		position: fixed;
		bottom: 0;
		text-align: center;
		width: 100%;
		background-color: #57b847;
		color: white;
	}

	.pravo{
		width: 200px;
		margin: auto;
		font-weight: bold;
		color: red;
	}

	.nadpisy{
		width: 100%;
		margin-top: -15px;
	}

	h1{
		float: left;
	}

	.zpet{
		float: right;
		text-align: right;
		margin-right: 22px;
		margin-top: 30px;
	}

	.formular{
		width: 100%;
		float: left;
	}

	.pridani{

	}

	table{
		border-collapse: collapse;
		width: 400px;
		margin: auto;
	}

	td{
		padding: 8px;
		border: 1px solid black;
	}

	input, select{
		width: 100%;
	}

	.submit{
		width: 200px;
		padding: 5px;
		/*border: 3px solid #f44336;*/
		height: 40px;
		/*margin-top: 30px;*/
		border-radius: 10px;
		text-align: center;
		background-color: #f44336;
		font-weight: bold;
		-webkit-transition: 0.5s;
      	transition: 0.5s;
      	color: white;
	}

	.submit:hover{
		/*border: 3px solid #ccc;*/
		background-color: #d4281c;
	}

	.mazani{
		width: 200px;
		margin: auto;
	}
</style>
</HEAD>
<BODY>
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
		<div class="nadpisy">
			<H1>Potvrzení smazání</H1>
			<FORM ACTION="index.php" CLASS="zpet">
				<INPUT TYPE=SUBMIT VALUE="< Zpět">
			</FORM>
		</div>
		<br><br><br><br>
		<hr>

		<div class="formular">
		<?php
		require("../connect.php");
		require 'protection.php';

		if($_SESSION["login"]=='admin')
		{
			$sql = "select * from hrac WHERE cislo=$_GET[oc]";      

			$vysledek = mysqli_query($spojeni, $sql);
			 
			$radek = mysqli_fetch_assoc($vysledek);
			  
			$oc=$radek[cislo];
			echo "Chcete tento záznam opravdu smazat?<br><br>";

			?>
			<div class="formular">
				<TABLE border=0>
					<TR>
						<TD>Číslo:</TD>
						<TD><?php echo $radek['cislo'] ?></TD>
					</TR>
					<TR>
						<TD>Jméno:</TD>
						<TD><?php echo $radek['jmeno'] ?></TD>
					</TR>
					<TR>
						<TD>Příjmení:</TD>
						<TD><?php echo $radek['prijmeni'] ?></TD>
					</TR>
					<TR>
						<TD>Tým:</TD>
						<TD><?php echo $radek['tym'] ?></TD>
					</TR>
				</TABLE><br><br>
				<div class="mazani">
					<FORM ACTION=delete.php method=GET>
					<INPUT TYPE=HIDDEN NAME=oc VALUE="<?php echo $_GET[oc] ?>">
					<INPUT TYPE=SUBMIT VALUE="SMAZAT" CLASS="submit">
					</FORM>						
				</div>
			
			</div>

			<?php
			  mysqli_close($spojeni);
			?>

		</div>


		<?php
			} else {
				echo "<div class=pravo>";
				echo "Nemáte potřebná práva";
				echo "</div>";
			}
		?>
	</div>
	<div class="paticka">
			<p>&copy; Jan Straka 2020</p>
	</div>
</BODY>
</HTML>
