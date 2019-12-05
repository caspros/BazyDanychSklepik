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

	if(isset($_POST['koszyk1']))
	{
		$id_k= $_SESSION['id_klienci'];
		$cena = $_SESSION['cena'];
		$id = $_SESSION['produkt'];
		$ile = $_POST['ile_sztuk'];
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "sklep";
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn -> query("SET NAMES 'utf8'");
		if ($conn -> connect_error) { die("Nie połączono z bazą danych: " . $conn -> connect_error);}
		$sql_t = "SET FOREIGN_KEY_CHECKS = 0";
		$result = $conn -> query($sql_t);
		$sql = "INSERT INTO koszyk(ilosc, cena, id_produkty, id_klienci) VALUES ('$ile', '$cena', '$id', '$id_k')";
		$result = $conn -> query($sql);
	}

	//Skladanie zamowienia
	if(isset($_POST['suma'])) {
		$suma1 = $_POST['suma'];
		$id_klienci = $_SESSION['id_klienci'];
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "sklep";
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn -> query("SET NAMES 'utf8'");
		if ($conn -> connect_error) { die("Nie połączono z bazą danych: " . $conn -> connect_error);}
		$sql_t = "SET FOREIGN_KEY_CHECKS = 0";
		$result = $conn -> query($sql_t);
		if($suma1>0)
		{
			$sql_suma = "SELECT * FROM koszyk WHERE id_klienci = '$id_klienci'";
			$result = $conn -> query($sql_suma);
		} 
		else
		{ 
			$_SESSION['pusty_koszyk'] = "Twój koszyk jest pusty! Dodaj produkty do koszyka.";
		}
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
	<title>Twój koszyk</title>
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
	<div id="container_koszyk">
		

		<!-- MIĘSO ARMATNIE -->
		<div id="koszyk_container">
			<?php
				Show_cart();
			?>

			<?php
				if (isset($_SESSION['pusty_koszyk']))
				{
					echo '<div class="error">'.$_SESSION['pusty_koszyk'].'</div>';
					unset($_SESSION['pusty_koszyk']);
				}
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

	//Function to show products in cart
	function Show_cart()
	{	
		$suma = 0;
		$suma_dostawa = 0;
		$id_klienci = $_SESSION['id_klienci'];
		require_once "connect.php";
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
	 			$id_prod = $row['id_produkty'];
	 			$sql1 = "SELECT id_produkty, nazwa, cena, producent, zdjecie, dostawa FROM produkty WHERE id_produkty=$id_prod";
	 			$result1 = $conn -> query($sql1);
	 			//Czy jest zamowienie_produkty
	 			if ($result1 -> num_rows > 0)
				{
	 				while($row1 = $result1 -> fetch_assoc())
	 				{
	 					$suma += $row["cena"]*$row["ilosc"];
	 					echo '<a href="produkt.php?id_produkty='.$row1["id_produkty"].'" id="product_link">
				       		<div class="koszyk">
				       			<table id="koszyk_t">
				       				<tr>
				       					<td><div id="zdjecie"><img src="images/products/'.$row1["zdjecie"].'" width="100" height="100" alt="product.png"></div></td>
						       			<td><div class="nazwa">'.$row['ilosc'].'x <b>'.$row1["nazwa"].'</b></div></td>
							       		<td>Producent: '.$row1['producent'].'</td>
							       		<td colspan="2"><div id="cena">Cena: '.$row["cena"]*$row["ilosc"].' PLN</b></div></td>
							       		<td style="color:green;">Dostawa: ';
							       		switch ($row['ilosc']%5)
							       		{
											case 0:
											$dostawa = ($row["ilosc"] / 5 ) * 12;
											$suma += $dostawa;
											$suma_dostawa += $dostawa;
											echo $dostawa;
											break;
											case 1:
											$dostawa = 12 + (($row["ilosc"] - 1) / 5 ) * 12;
											$suma += $dostawa;
											$suma_dostawa += $dostawa;
											echo $dostawa;
											break;
											case 2:
											$dostawa = 12 + (($row["ilosc"] - 2) / 5 ) * 12;
											$suma += $dostawa;
											$suma_dostawa += $dostawa;
											echo $dostawa;
											break;
											case 3:
											$dostawa = 12 + (($row["ilosc"] - 3) / 5 ) * 12;
											$suma += $dostawa;
											$suma_dostawa += $dostawa;
											echo $dostawa;
											break;
											case 4:
											$dostawa = 12 + (($row["ilosc"] - 4) / 5 ) * 12;
											$suma += $dostawa;
											$suma_dostawa += $dostawa;
											echo $dostawa;
											break;
										}
							       		echo ' PLN</td>
							       		<td><form action="#" method="post">
							       			<input type="hidden" name="id_k" value="'.$row["id_koszyk"].'" />
							       			<input type="submit" name="delete" value="Usuń">
							       		</form></td>
						       		</tr>
					       		</table>
				       		</div>
	       				<a>';	
	 				}
	 			}
				
	       		$_SESSION['suma'] = $suma;
			}
		} else { echo '<div class="error" style="text-align:center;">Brak produktów w koszyku</div>'; }
		echo '<br>
		<div id="podsumowanie">Kwota całkowita: '.$suma.' PLN<br>
		<div id="dostawa1" style="color:green;">W tym dostawa: '.$suma_dostawa.' PLN
		<br><br>
		<form action="skladanie_zam.php" method="post">
			<input type="hidden" name="suma" value="'.$suma.'" />
			<input type="submit" id="kup_teraz" name="zloz_zam" value="Złóż zamówienie">
		</form>
		</div>';
	}

	//Usuwanie z koszyka
	if(isset($_POST['id_k'])) {
		$id = $_POST['id_k'];
		$sql_d= "DELETE FROM koszyk WHERE id_koszyk = '$id'";
		$result = $conn -> query($sql_d);
		echo "<meta http-equiv='refresh' content='0'>";
	}

	function DeletePosition()
	{
		$id_klienci = $_SESSION['id_klienci'];
		require_once "connect.php";
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn -> query("SET NAMES 'utf8'");
		if ($conn -> connect_error) { die("Nie połączono z bazą danych: " . $conn -> connect_error);}
		$sql = "DELETE * FROM koszyk WHERE id_koszyk=$id_kosz";
		$result = $conn -> query($sql);
	}
?>