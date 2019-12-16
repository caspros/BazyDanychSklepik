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
	<link rel="stylesheet" type="text/css" href="css/kategoria.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
	<link href="fontawesome/css/all.css" rel="stylesheet">
	<title>Kategorie</title>
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
			<form action="wyszukaj.php" method="get" class="form_inline">
				<li>
					<input type="text" name="search_input" class="search_input" placeholder="Wyszukaj produkt...">
				</li>

				<li>
					<input style="display: inline;" type="submit" name="search_button" class="search_button" value="SZUKAJ">
				</li>
			</form>

			<!-- koszyk -->
			<li>
				<a href="koszyk.php">
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
		    		<a href="zamowienia.php">Zamówienia</a>
					<a href="ocena_produktu.php">Oceń produkt</a>
					<a href="ocena_sklepu.php">Oceń sklep</a>
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
		<div id="categories">
			<br>

			<span class="kat"><b>Kategorie:</b></span>
			<br><br>
			<a href="kategoria.php?id_kategorie=1">Koszulki</a><br>
			<a href="kategoria.php?id_kategorie=2">Spodnie</a><br>
			<a href="kategoria.php?id_kategorie=3">Kubki</a><br>
			<a href="kategoria.php?id_kategorie=4">Długopisy</a><br>
			<a href="kategoria.php?id_kategorie=5">Bluzy</a><br>
			<a href="kategoria.php?id_kategorie=6">Naklejki</a><br>
			<a href="kategoria.php?id_kategorie=7">Ramki</a><br>
			<a href="kategoria.php?id_kategorie=8">RTV</a><br>
			<a href="kategoria.php?id_kategorie=9">AGD</a><br>
			<a href="kategoria.php?id_kategorie=10">Alkohol</a><br>
			<a href="kategoria.php?id_kategorie=11">Zabawki</a><br>
			<a href="kategoria.php?id_kategorie=0">Wszystko</a><br>

		</div>

		<!-- MIĘSO ARMATNIE -->
		<div id="main">
			<?php
				Searching();
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
	
</body>
</html>


<?php
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

	//Function to show products in categories
	function Searching()
	{	
		$szukane = $_GET['search_input'];
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "sklep";
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn -> query("SET NAMES 'utf8'");
		if ($conn -> connect_error) { die("Nie połączono z bazą danych: " . $conn -> connect_error);}

		echo '<h1>Znalezione produkty</h1>';
		$sql = "SELECT id_produkty, nazwa, opis, opinie_klientow, cena, dostepna_ilosc, producent, rozmiar, zdjecie, dostawa FROM produkty WHERE nazwa LIKE '%$szukane%'";
		$result = $conn -> query($sql);
		if ($result -> num_rows > 0)
		{
	 		while($row = $result -> fetch_assoc())
	 		{
	       		echo '<a href="produkt.php?id_produkty='.$row["id_produkty"].'" id="product_link"><div class="product_kat">
			       		<div id="zdjecie"><img src="images/products/'.$row["zdjecie"].'" width="200" height="200" alt="product.png"></div>
			       		<div class="zawartosc">
			       			<table id="tabela">
					       		<tr>
					       			<th colspan="2"><div class="nazwa"><b>'.$row["nazwa"].'</b></div></th>
					       			<th><div id="cena">Cena: '.$row["cena"].' PLN</b></div></th>
					       		</tr>
					       		<tr>
						       		<td><div class="rozmiar">Rozmiar: ';
						       		if(is_null($row["rozmiar"]))
						       		{
						       			echo 'Nie dotyczy';
						       		}else echo $row["rozmiar"];
						       		echo '</div></td>
						       		<td><div class="producent">Producent: '.$row['producent'].'</div></td>
						       		<td><span style="color:green;font-style:normal;">Dostawa: '.$row['dostawa'].' PLN</span></td>
					       		</tr>
				       		</table>
			       		</div>
	       			</div><a>';
			}
		echo "<br><br><br><br>";

		} else { echo "Brak znalezionych produktów"; }
	
	}
?>
