<?php
require("../connect.php");
require 'protection.php';
?>

<HTML>
<HEAD>
<TITLE>Přidání nového hráče</TITLE>
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
		width: 400px;
		margin: auto;
	}

	table{
		border-collapse: collapse;
		width: 100%;
	}

	td{
		padding: 8px;
		border: 1px solid black;
	}

	input, select{
		width: 100%;
	}

	.submit{
		width: 50%;
		margin-left: 25%;
		padding: 5px;
		border: 3px solid #57b847;
		height: 40px;
		/*margin-top: 30px;*/
		border-radius: 10px;
		text-align: center;
		background-color: #57b847;
		font-weight: bold;
		-webkit-transition: 0.5s;
      	transition: 0.5s;
	}

	.submit:hover{
		border: 3px solid #ccc;
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
			<H1>Přidání nového hráče</H1>
			<FORM ACTION="index.php" CLASS="zpet">
				<INPUT TYPE=SUBMIT VALUE="< Zpět">
			</FORM>
		</div>
		<br><br><br><br>
		<hr>

		<div class="formular">
		<?php
		if($_SESSION["login"]=='admin')
		  {
		?>

			<FORM ACTION="insert.php" METHOD=GET CLASS="pridani">

			<TABLE border=0>
			<TR><TD>Osobní číslo:<TD>
			<INPUT type=text NAME=cislo SIZE=4>
			<TR><TD>Jméno:<TD>
			<INPUT NAME=jmeno>
			<TR><TD>Příjmení:<TD>
			<INPUT NAME=prijmeni>
			<TR><TD>Tým:<TD>
			<select size="1" name="tym">
				<?php                                      
		        $sql2 = "SELECT * from tym";
				$vysledek2 = mysqli_query($spojeni, $sql2);
		                  
				while ($tym = mysqli_fetch_assoc($vysledek2)): ?>
				<option value="<?php echo $tym["id_tym"]?>"><?php echo $tym["id_tym"]."  ".$tym["zeme"]?></option>
			<?php endwhile;?>
			</select>

			</TABLE>
			<BR>
			<INPUT TYPE=SUBMIT VALUE="PŘIDAT" CLASS="submit">
			</FORM>

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
