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
	<link rel="stylesheet" type="text/css" href="css/koszyk.css">
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

		</div>

		<!-- MIĘSO ARMATNIE -->
		<div id="koszyk_container">
			<?php
				Show_cart();
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
	$id_klienci = $_SESSION['id_klienci'];

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
	function Show_cart()
	{	
		$id_klienci = $_SESSION['id_klienci'];
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "sklep";
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn -> query("SET NAMES 'utf8'");
		if ($conn -> connect_error) { die("Nie połączono z bazą danych: " . $conn -> connect_error);}
		$sql = "SELECT * FROM koszyk WHERE id_klienci=$id_klienci";
		$result = $conn -> query($sql);
		echo '<h1>Twój koszyk</h1>';
		//Czy jest koszyk
		if ($result -> num_rows > 0)
		{
	 		while($row = $result -> fetch_assoc())
	 		{	
	 			$id_kosz = $row['id_koszyk'];
	 			$id_zam = $row['id_zamowienie_produkty'];
	 			$sql1 = "SELECT id_zamowienie_produkty, ile_sztuk, id_produkty FROM zamowienie_produkty WHERE id_zamowienie_produkty=$id_zam";
	 			$result1 = $conn -> query($sql1);
	 			//Czy jest zamowienie_produkty
	 			if ($result1 -> num_rows > 0)
				{
	 				while($row1 = $result1 -> fetch_assoc())
	 				{
	 					$id_prod = $row1['id_produkty'];
	 					$sql2 = "SELECT id_produkty, nazwa, cena, zdjecie FROM produkty WHERE id_produkty=$id_prod";
	 					$result2 = $conn -> query($sql2);
	 					//Czy sa produkty z zamowienia
			 			if ($result2 -> num_rows > 0)
						{
			 				while($row2 = $result2 -> fetch_assoc())
			 				{
			 					echo '<a href="produkt.php?id_produkty='.$row2["id_produkty"].'" id="product_link">
						       		<div class="koszyk">
						       			<table id="koszyk_t">
						       				<tr>
						       					<td><div id="zdjecie"><img src="images/products/'.$row2["zdjecie"].'" width="100" height="100" alt="product.png"></div></td>
								       			<td><div class="nazwa"><b>'.$row2["nazwa"].'</b></div></td>
									       		<td>Id produktu: '.$row1['id_produkty'].'</td>
									       		<td>Ile sztuk: '.$row1['ile_sztuk'].'</td>
									       		<td colspan="2"><div id="cena">Cena: '.$row["kwota"].' PLN</b></div></td>
									       		<td><form action="#" method="post">
									       			<input type="hidden" name="id_k" value="'.$row["id_koszyk"].'" />
									       			<input type="submit" name="delete" value="Usuń"></button>
									       		</form></td>
								       		</tr>
							       		</table>
						       		</div>
			       				<a>';
			       			}
			       		}
	 				}
	 			}
				
	       		
			}
		} else { echo "Brak produktów w koszyku"; }
	}

	if(isset($_POST['id_k'])) {
		$id = $_POST['id_k'];
		$sql_d= "DELETE FROM koszyk WHERE id_koszyk = '$id'";
		$result = $conn -> query($sql_d);
		echo "<meta http-equiv='refresh' content='0'>";
	}


	function DeletePosition()
	{
		$id_klienci = $_SESSION['id_klienci'];
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "sklep";
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn -> query("SET NAMES 'utf8'");
		if ($conn -> connect_error) { die("Nie połączono z bazą danych: " . $conn -> connect_error);}
		$sql = "DELETE * FROM koszyk WHERE id_koszyk=$id_kosz";
		$result = $conn -> query($sql);
	}
?>