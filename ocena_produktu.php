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
	<title>Wybierz produkt do oceny</title>
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
	<div id="container_glowny_ocena">

		

		<!-- MIĘSO ARMATNIE -->
		<div id="ocena_container">

			<h1>Oceń zakupione produkty</h1>

			<div id="informacja1">
				Wybierz z listy zakupionych produktów przedmiot który chcesz ocenić. <br>
				Dzięki Waszym opiniom stale możemy ulepszać jakość naszych usług.<br><br>
			</div>
				<?php
					Produkty_do_oceny();

					echo '<h1 style="clear: both;"><br><br>Twoje ocenione produkty</h1><br><br>';

					Moje_ocenione_produkty();
				?>
				<br><br>
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

	//Funkcja wyświetlająca produkty do oceny
	function Produkty_do_oceny()
	{	
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "sklep";
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn -> query("SET NAMES 'utf8'");
		if ($conn -> connect_error) { die("Nie połączono z bazą danych: " . $conn -> connect_error);}
		
        $id_klienci = $_SESSION['id_klienci'];
		$sql = "SELECT  p.id_produkty, p.nazwa, p.opis, p.opinie_klientow, p.cena, p.dostepna_ilosc, p.producent, p.rozmiar, p.zdjecie, p.dostawa, x.data_zlozenia
		FROM zamowienie_produkty z, produkty p, zamowienia x WHERE z.id_klienci=$id_klienci AND z.id_produkty=p.id_produkty AND x.data_wyslania > '1000-10-05' AND z.id_zamowienia=x.id_zamowienia";
		
		
		$result = $conn -> query($sql);
		
		if ($result -> num_rows > 0)
		{
	 		while($row = $result -> fetch_assoc())
	 		{
	 			$sql_sprawdzenie = "SELECT id_produkty, id_klienci FROM opinie WHERE id_klienci=$id_klienci AND id_produkty=".$row["id_produkty"];
	 			$result_spr = $conn -> query($sql_sprawdzenie);
	 			if ($result_spr -> num_rows > 0) { }
	 			else
				{
	 			
	 				echo '<div class="zawartosc">
				       			<table id="tabela">
						       		<td rowspan="2">
						       			<a href="produkt.php?id_produkty='.$row["id_produkty"].'" id="product_link"><div id="zdjecie"><img src="images/products/'.$row["zdjecie"].'" width="120" height="120" alt="product.png"></div></a>					       			
						       		</td>

						       		<td colspan="2">
							       			<div class="nazwa"><b>'.$row["nazwa"].'</b></div>
						       		</td>

						       		<tr>
							       		<td><div id="cena">Cena: '.$row["cena"].' PLN</b></div></td>
							       		<td>Zakupiono: '.$row["data_zlozenia"].'</td>
							       		<td><a href="ocena_przedmiotu.php?id_produkty='.$row["id_produkty"].'"><button id="ocen_produkt_btn" >Oceń produkt</button></a></td>
						       		</tr>
					       		</table>
	       					</div>';
	 			}
			}
		} else { echo '<br><br><span class="no_products">Brak produktów do oceny</span>'; }
	}

	//Funkcja wyświetlająca ocenione produkty
	function Moje_ocenione_produkty()
	{	
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "sklep";
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn -> query("SET NAMES 'utf8'");
		if ($conn -> connect_error) { die("Nie połączono z bazą danych: " . $conn -> connect_error);}
		
        $id_klienci = $_SESSION['id_klienci'];
		$sql = "SELECT id_klienci, id_produkty, gwiazdka, opinia FROM opinie WHERE id_klienci=$id_klienci";
		
		$result = $conn -> query($sql);
		
		if ($result -> num_rows > 0)
		{
	 		while($row = $result -> fetch_assoc())
	 		{
	 			$sql2 = "SELECT id_produkty, nazwa, zdjecie, cena FROM produkty WHERE id_produkty=".$row["id_produkty"];

	 			$result2 = $conn -> query($sql2);
	 			if (!$result2) {
					    trigger_error('Invalid query: ' . $conn->error);
					}
				if ($result2 -> num_rows > 0)
				{
			 		while($row2 = $result2 -> fetch_assoc())
			 		{
	 					echo '<div class="zawartosc">
				       			<table id="tabela">
						       		<tr>
						       			<td rowspan="2">
							       			<a href="produkt.php?id_produkty='.$row2["id_produkty"].'" id="product_link"><div id="zdjecie"><img src="images/products/'.$row2["zdjecie"].'" width="120" height="120" alt="product.png"></div>
							       			</a>
						       			</td>

						       			<td colspan="2">
							       			<div class="nazwa">
							       				<b>'.$row2["nazwa"].'</b>
							       			</div>
						       			</td>

						       			<tr>
						       			<td><div id="cena">
							       				Cena: '.$row2["cena"].' PLN</b>
							       			</div>						       			
							       		</td>
							       		</tr>
						       			
						       		</tr>

						       		<tr>
						       			<td>Ocena: '.$row["gwiazdka"].'</td>
						       			<td>Opinia: '.$row["opinia"].'</td>
						       		</tr>

					       		</table>
	       					</div>';
	 				}
	 			}
			}
		} else { echo '<br><br><span class="no_products">Brak ocenionych produktów</span>'; }
	}


?>
