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
	<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/hamburger.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="(max-width: 800px">

	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link rel="stylesheet" type="text/css" href="css/koszyk.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
	<link href="fontawesome/css/all.css" rel="stylesheet">
	<title>Zamówienie złożone!</title>
</head>

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
	<div id="container_koszyk">
		

		<!-- MIĘSO ARMATNIE -->
		<div id="koszyk_container">
			<h2>Dziękujemy! Zamówienie zostało złożone!</h2><br>
			<?php
				Zloz_zamowienie();
			?>
			<br><br><br><br>

		</div>
	</div>

    <div id="centeredmenu">
	   <ul>
	      <li><a href="FAQ.php">FAQ</a></li>
	      <li><a href="kontakt.php">Kontakt</a></li>
	      <li><a href="regulamin.php">Regulamin</a></li>
	   </ul>
	</div>

	<div id="footer">
		Korzystanie z serwisu oznacza akceptację
		<a href="regulamin.php">
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
	
</body>
</html>


<?php
	//Function to confirm order
	function Zloz_zamowienie()
	{	
		$suma = $_SESSION['suma'];
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
		//Czy jest koszyk
		if ($result -> num_rows > 0)
		{
	 		while($row = $result -> fetch_assoc())
	 		{	
	 			$id_kosz = $row['id_koszyk'];
	 			$id_prod = $row['id_produkty'];

	 			$sql1 = "SELECT id_produkty, nazwa, cena, zdjecie FROM produkty WHERE id_produkty=$id_prod";
	 			$result1 = $conn -> query($sql1);
	 			//Czy jest zamowienie_produkty
	 			/*if ($result1 -> num_rows > 0)
				{
					//Zliczanie ceny zamowienia
	 				while($row1 = $result1 -> fetch_assoc())
	 				{
	 					$suma += $row["cena"]*$row["ilosc"];
	 					
	 				}
	 			}*/
			}
		} else { echo "Brak produktów w koszyku"; }

		//Dodanie rekordu w tabeli zamowienia
		$data_zlozenia = date("Y-m-d H:i:s");
		$sql_zamowienia = "INSERT INTO zamowienia(data_zlozenia, data_wyslania, zaplacono, id_klienci, suma) VALUES ('$data_zlozenia','0000-00-00', '0', '$id_klienci', '$suma')";
		$sql_t = "SET FOREIGN_KEY_CHECKS = 0";
		$result = $conn -> query($sql_t);
		$result = $conn -> query($sql_zamowienia);
		$sql = "SELECT id_zamowienia FROM zamowienia WHERE id_klienci=$id_klienci";
		$result = $conn -> query($sql);
		while($row = $result -> fetch_assoc())
	 	{	
	 		$id_zam = $row['id_zamowienia'];
	 	}

		$sql = "SELECT * FROM koszyk WHERE id_klienci=$id_klienci";
		$result = $conn -> query($sql);
		while($row = $result -> fetch_assoc())
	 	{	
 			$id_kosz = $row['id_koszyk'];
 			$ilosc = $row['ilosc'];
 			$cena = $row['cena'];
 			$id_prod = $row['id_produkty'];

 			//Dodanie rekordu w tabeli zamowienie_produkty
 			$sql_zam_prod = "INSERT INTO zamowienie_produkty(ilosc, cena, id_produkty, id_klienci, id_zamowienia) VALUES ('$ilosc','$cena', '$id_prod', '$id_klienci', '$id_zam')";
 			$result1 = $conn -> query($sql_zam_prod);

 			//Usuniecie pozycji z koszyka
			$sql_d= "DELETE FROM koszyk WHERE id_koszyk = '$id_kosz'";
			$result1 = $conn -> query($sql_d);

			//Zmniejszenie dostepnej ilosci produktow
			$sql_ilosc1 = "SELECT dostepna_ilosc FROM produkty WHERE id_produkty='$id_prod'";
			$result1 = $conn -> query($sql_ilosc1);
			$row1 = $result1 -> fetch_assoc();
			$nowa_ilosc = $row1['dostepna_ilosc'] - $ilosc;
			$sql_ilosc = "UPDATE produkty SET dostepna_ilosc='$nowa_ilosc' WHERE id_produkty='$id_prod'";
			$result1 = $conn -> query($sql_ilosc);
		}



		echo '<h1>Dane do przelewu:</h1>';
		echo '<br>
		<div id="podsumowanie1">
			<b>BNP Paribas<br>
			61 1090 1014 0000 0712 1981 2874<br><br>
			Alledrogo sp. z o.o.<br>
			ul. Przykładowa 15<br> 58-560 Jelenia Góra<br><br>
			Tytuł przelewu: Zamowienie'.$id_zam.'<br>
			Kwota przelewu: '.$suma.' PLN</b><br>';

	}
?>