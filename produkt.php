<?php
	session_start();
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		$_SESSION['wyloguj'] = "Wyloguj";
		unset($_SESSION['zaloguj']);
	} else {
		$_SESSION['zaloguj'] = "Zaloguj";
		unset($_SESSION['wyloguj']);
	}
?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
	<link href="fontawesome/css/all.css" rel="stylesheet">
	<title>Alledrogo</title>
</head>

<body>
	<!-- STICKY MENU -->
	<div id="sticky_menu">
		<ol>
			<!-- logo alledrogo -->
			<li>
				<a href="index.php">
					<img src="images/logo.png" alt="logo" class="nav_img">
				</a>
			</li>

			<!-- wyszukiwanie -->
			<form form action="#" method="get" class="form_inline">
				<li>
					<a href="#">
						<input type="text" name="search_input" class="search_input" placeholder="Wyszukaj produkt...">
					</a>
				</li>

				<li>
					<a href="#">
						<input style="display: inline;" type="submit" name="search_button" class="search_button" value="SZUKAJ">
					</a>
				</li>
			</form>

			<!-- koszyk -->
			<li>
				<a href="#">
					<span class="koszyk">
						<i class="fas fa-shopping-cart"></i>
					</span>
				</a>
			</li>

			<!-- DROPDOWN BUTTON -->
			<div class="dropdown">
				<span id="myBtn" class="dropbtn">Witaj, 
					<?php 
					if (isset($_SESSION['wyloguj']))
						{
							echo $_SESSION['imie'];
						} else {
							echo "zaloguj się";
						}
					?> 

					<div id="p1">
						<i class="fas fa-angle-down"></i>
					</div>
				</span>

				<!-- DROPDOWN CONTENT -->
	  			<div id="myDropdown" class="dropdown-content">
		    		<a href="zamowienia.php">Moje zamówienia</a>
					<a href="#">Oceń produkt</a>
					<a href="profil.php">Ustawienia</a>
					<?php
						if (isset($_SESSION['zaloguj']))
						{
							echo '<a href="logowanie.php">'.$_SESSION['zaloguj'].'</a>';
						} else{
							echo '<a href="wyloguj.php">'.$_SESSION['wyloguj'].'</a>';
						}
					?>
	  			</div>
			</div>
		</ol>
	</div>
	
	<!-- GŁÓWNY CONTAINER -->
	<div id="container_produkt">

		<!-- MIĘSO ARMATNIE -->
		<div id="main">
			<?php

				$id_produktu = $_GET['id_produkty'];
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "sklep";
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				$conn -> query("SET NAMES 'utf8'");
				// Check connection
				if ($conn -> connect_error) {
					    die("Nie połączono z bazą danych: " . $conn -> connect_error);
					}

				$sql = "SELECT nazwa, opis, opinie_klientow, cena, dostepna_ilosc, producent, rozmiar, zdjecie FROM produkty WHERE id_produkty=$id_produktu";
				$result = $conn -> query($sql);

				

				//Function to show product on main site
				function Show_product($id)
				{	
					$id_produktu = $_GET['id_produkty'];
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "sklep";
					$conn = new mysqli($servername, $username, $password, $dbname);
					$conn -> query("SET NAMES 'utf8'");
					if ($conn -> connect_error) { die("Nie połączono z bazą danych: " . $conn -> connect_error);}

					$sql = "SELECT nazwa, opis, opinie_klientow, cena, dostepna_ilosc, producent, rozmiar, zdjecie FROM produkty WHERE id_produkty=$id_produktu";
					$result = $conn -> query($sql);
					if ($result -> num_rows > 0)
					{
				 		while($row = $result -> fetch_assoc())
				 		{
				       		echo '<div id="produkt_big"><img src="images/products/'
				       		.$row["zdjecie"].'" width="500" height="500" alt="product.png"><br><b>'
				       		.$row["nazwa"]
				       		.'</b><br><br>Specyfikacja produktu<br><br><div id="dane">Rozmiar: ';
				       		if(is_null($row["rozmiar"]))
				       		{
				       			echo 'Nie dotyczy';
				       		}else echo $row["rozmiar"];
				       		echo '<br>Producent: '.$row["producent"].
				       		'</div><br><br>Opis produktu: <br>'.$row["opis"].
				       		'<br><br><input type="number" id="ile_sztuk" value="1" min="1" max='.$row["dostepna_ilosc"].'> z <b>'.$row["dostepna_ilosc"].' sztuk</b>'.
				       		'<br><br><button id="kup_teraz"><span style="color:white"><b>KUP TERAZ: '.$row["cena"]." PLN</b></span></button></div>";
						}
					} else { echo "No results"; }
				}


				Show_product($id_produktu);
			?>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

		</div>
	</div>

    <div id="centeredmenu">
	   <ul>
	      <li><a href="#">FAQ</a></li>
	      <li><a href="#">Kontakt</a></li>
	      <li><a href="#">Regulamin</a></li>
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
	<!-- SLIDER JS-->
	<script src="js/slider.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- TU BĘDĘ JESZCZE POPRAWIAŁ

	<script>
	jQuery(function($) {
	  $('#cena').text($('#ile_sztuk').val());

	  $('#ile_sztuk').on('input', function() {
	    $('#cena').text($('#ile_sztuk').val()*50);
	  });
	});
	</script>
		-->
	
</body>
</html>



