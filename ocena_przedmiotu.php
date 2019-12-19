<?php
	session_start();
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		$_SESSION['wyloguj'] = "Wyloguj";
		unset($_SESSION['zaloguj']);
	} else {
		$_SESSION['zaloguj'] = "Zaloguj";
		unset($_SESSION['wyloguj']);
		header('Location: index.php');
		exit();
	}
?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/ocena.css">
		<link rel="stylesheet" type="text/css" href="css/hamburger.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="(max-width: 800px">

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
	<link href="fontawesome/css/all.css" rel="stylesheet">
	<title>Ocena produktu</title>
</head>
<style>
	.error
		{
			color:red;
			margin-top: 10px;
			margin-bottom: 10px;
		}
</style>

<body>
	 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<div class="topnav" id="myTopnav">

	    <a href="index.php" class="active">alledrogo</a>
	    
		<?php
						if (isset($_SESSION['zaloguj']))
						{
							echo '<a href="logowanie.php">'.$_SESSION['zaloguj'].'</a>';
						} else{
							echo '<a href="wyloguj.php">'.$_SESSION['wyloguj'].'</a>';
						}
		?>
	    <a href="koszyk.php">Koszyk</a>
		<a href="zamowienia.php">Zamówienia</a>
		<a href="ocena_produktu.php">Oceń produkt</a>
		<a href="ocena_sklepu.php">Oceń sklep</a>
		<a href="profil.php">Ustawienia</a>
		
		<a class="forma">
		  	<form action="wyszukaj.php" method="get" class="form_inline2">
						<input type="text" name="search_input" class="search_input" placeholder="Wyszukaj produkt...">
						<input type="submit" name="search_button" class="search_button" value="SZUKAJ">
			</form>
		</a>
	   
	  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
	    <i class="fa fa-bars"></i>
	  </a>
	</div> 
	
	<!-- GŁÓWNY CONTAINER -->
	<div id="container_glowny_ocena">
		<h1>Oceń produkt</h1>

		<!-- MIĘSO ARMATNIE -->
		<div id="container_produkt">
		
		<?php
			if(!$_GET['id_produkty'])
			{
				header('Location: ocena_produktu.php');
				exit();
			}
			else
			{
               	$id_produktu = $_GET['id_produkty'];
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "sklep";
				$conn = new mysqli($servername, $username, $password, $dbname);
				$conn -> query("SET NAMES 'utf8'");
				if ($conn -> connect_error) {die("Nie połączono z bazą danych: " . $conn -> connect_error);}
				$id_klienci = $_SESSION['id_klienci'];
				
				$sql_sprawdzenie = "SELECT * FROM zamowienie_produkty z, zamowienia x WHERE z.id_klienci=$id_klienci and z.id_produkty=$id_produktu and x.data_wyslania > '1000-10-05'";
				$result_s = $conn -> query($sql_sprawdzenie);
				if ($result_s -> num_rows > 0)
				{
					if($row_s = $result_s -> fetch_assoc())
					{
						 $_SESSION['juz_oceniono'] = FALSE;
						$sql = "SELECT * FROM opinie WHERE id_klienci=$id_klienci";
						$result = $conn -> query($sql);
						while($row = $result -> fetch_assoc())
						{
							if($row['id_produkty']==$id_produktu)
							{
								$_SESSION['juz_oceniono'] = TRUE;
							}
						}

						if((isset($_SESSION['juz_oceniono'])) && ($_SESSION['juz_oceniono']==TRUE))
						{
							$sql1 = "SELECT * FROM opinie WHERE id_klienci=$id_klienci and id_produkty=$id_produktu";//tu trzeba odpowiednie id dac
							$result1 = @$conn -> query($sql1);
							if ($result -> num_rows > 0)
							{
								if($row1 = $result1 -> fetch_assoc())
								{
									echo '<h2>Już oceniłeś ten produkt, dziękujemy!</h2><br>';
									echo '<div id="dziekujemy">Twoja ocena: <b>'.$row1['gwiazdka'].'/5</b><br>';
									echo 'Twoj komentarz: <b>'.$row1['opinia'].'</b></div>';
								}
							}
						}
						else
						{
							echo '<div id="formularz">
									<form action="addingOcenaProduktu.php" method="post">
									
										Ocena: 
										<select name="ocena">
										  <option value="1">1</option>
										  <option value="2">2</option>
										  <option value="3">3</option>
										  <option value="4">4</option>
										  <option value="5">5</option>
										 
										</select>
										<input type="hidden" name="id_produktu" value="'.$id_produktu.'">
										<br><span id="koment">Komentarz:</span><br>
										<textarea name="opis" cols="50" rows="3"></textarea><br><br>
										<input name="submit" id="dalej_btn" type=submit value="Dodaj">
										
									</form>
								</div>';
						}
					}
					
				}
				else
					{
						header('Location: ocena_produktu.php');
						exit();
					}
				
               
			}

			?>
		
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

		</div>
	</div>

    <div id="centeredmenu">
	   <ul>
	      <li><a href="FAQ.php">FAQ</a></li>
	      <li><a href="#">Kontakt</a></li>
	      <li><a href="regulamin.php">Regulamin</a></li>
	   </ul>
	</div>

	<div id="footer">
		Korzystanie z serwisu oznacza akceptację
		<a href="#">
			regulaminu
		</a>
	</div>	

	<!-- JQUERY -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<!-- STICKY MENU JS-->
	<script src="js/sticky_menu.js"></script>
	<!-- STICKY MENU WITAJ ZALOGUJ SIĘ JS-->
	<script src="js/dropdown_sticky.js"></script>
	<script>
	/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
	/* to ten słynny hamburger*/
	function myFunction() {
	  var x = document.getElementById("myTopnav");
	  if (x.className === "topnav") {
	    x.className += " responsive";
	  } else {
	    x.className = "topnav";
	  }
	} 
	</script>
	<!-- SLIDER JS-->
	<script src="js/slider.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
</body>
</html>