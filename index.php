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
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link rel="stylesheet" type="text/css" href="css/hamburger.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="(max-width: 800px">


  <link rel="stylesheet" href="css/responsiveslides.css">
  <link rel="stylesheet" href="css/demo.css">

	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
	<link href="fontawesome/css/all.css" rel="stylesheet">
	<title>Alledrogo</title>

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
	<div id="container">

		<!-- MIĘSO ARMATNIE -->
		<div id="main">

			<!-- KATEGORIE -->
			    <div id="centeredmenu">
				   <ul>
				   	<li><a href="kategoria.php?id_kategorie=1">Koszulki</a><br></li>
					<li><a href="kategoria.php?id_kategorie=2">Spodnie</a><br></li>
					<li><a href="kategoria.php?id_kategorie=3">Kubki</a><br></li>
					<li><a href="kategoria.php?id_kategorie=4">Długopisy</a><br></li>
					<li><a href="kategoria.php?id_kategorie=5">Bluzy</a><br></li>
					<li><a href="kategoria.php?id_kategorie=6">Naklejki</a><br></li>
					<li><a href="kategoria.php?id_kategorie=7">Ramki</a><br></li>
					<li><a href="kategoria.php?id_kategorie=8">RTV</a><br></li>
					<li><a href="kategoria.php?id_kategorie=9">AGD</a><br></li>
					<li><a href="kategoria.php?id_kategorie=10">Alkohol</a><br></li>
					<li><a href="kategoria.php?id_kategorie=11">Zabawki</a><br></li>
					<li><a href="kategoria.php?id_kategorie=0">Wszystko</a><br></li>
				   </ul>
				</div>

			<div id="wrapper">
				<!-- Slideshow 2 -->
			    <ul class="rslides" id="slider2">
			      <li><a href="#"><img src="images/banners/black_friday.png" alt=""></a></li>
			      <li><a href="#"><img src="images/banners/darmowa_dostawa.png" alt=""></a></li>
			      <li><a href="#"><img src="images/banners/rabat_rtv.png" alt=""></a></li>
			    </ul>
			</div>

			<br>
			<h1>WYRÓŻNIONE PRODUKTY:</h1>

			<!-- PRODUKTY NA GŁÓWNEJ -->
			<div id="products">
				<br>

				<a href="produkt.php?id_produkty=53"><div class="product"><?php Show_product(53);?></div></a>
				<a href="produkt.php?id_produkty=52"><div class="product"><?php Show_product(52);?></div></a>
				<a href="produkt.php?id_produkty=84"><div class="product"><?php Show_product(84);?></div></a>
				<a href="produkt.php?id_produkty=93"><div class="product"><?php Show_product(93);?></div></a>
				<a href="produkt.php?id_produkty=56"><div class="product"><?php Show_product(56);?></div></a>
				<a href="produkt.php?id_produkty=94"><div class="product"><?php Show_product(94);?></div></a>

			</div>


			<div id="why_us" class="clearfix">
				<br><br>
				<h1>Dlaczego warto nam zaufać?</h1>

				<div class="why_us_main_container">
					<div class="why_us_content">
						<h3>Gwarancja jakości</h3>
						<br>
						Nasze produkty są bardzo dobre jakościowo, wykonane z dbałością o każdy szczegół. Podczas produkcji działamy zgodnie z ekologią. Robiąc u nas zakupy masz pewność, że zamówione produkty będą Ci służyły bardzo długo.
						<br><br>
						<img src="images/quality.png" alt="jakosc" height="35%" width="35%">
					</div>

					<div class="why_us_content">
						<h3>Darmowe zwroty do 14 dni</h3>
						<br>
						Nasza strona oferuje możliwość zwrotu zakupionego produktu do 14 dni od momentu otrzymania towaru bez potrzeby podania przyczyny zwrotu! Zwrot jest całkowicie darmowy, przesyłkę zwrotną pokrywamy my!
						<br><br>
						<img src="images/zwrot.png" alt="zwrot" height="35%" width="45%">
					</div>

					<div class="why_us_content">
						<h3>Opinie klientów</h3>
						<br>
						Jeśli jeszcze masz wątpliwości, zajrzyj do opinii naszych klientów, którzy zakupili już nasze produkty. Obiektywne opinie z pewnością pomogą Ci w podjęciu decyzji o opłacalności danych produktów. Dzięki opiniom jesteśmy w stanie dla Was stale ulepszać nasze produkty.
						<br><br>
						<img src="images/opinie.png" alt="zwrot" height="30%" width="75%">
					</div>
				</div>
			</div>
			<div id="comentaries">
				<?php
					Show_opinion(5);
					Show_opinion(2);
					Show_opinion(4);
				?> 
			</div>
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
	<!-- STICKY MENU WITAJ ZALOGUJ SIĘ JS-->
	<script src="js/dropdown_sticky.js"></script>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <script src="js/responsiveslides.min.js"></script>
  <script>
    // You can also use "$(window).load(function() {"
    $(function () {

      // Slideshow 2
      $("#slider2").responsiveSlides({
        auto: true,
        pager: true,
        speed: 300
      });
    });

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

	$sql = "SELECT nazwa, opis, opinie_klientow, cena, dostepna_ilosc, producent, rozmiar, zdjecie FROM produkty";
	$sql1 = "SELECT * FROM opinie";
	$result = $conn -> query($sql);
	$result1 = $conn -> query($sql1);

	//Function to show product on main site
	function Show_product($id)
	{	
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "sklep";
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn -> query("SET NAMES 'utf8'");
		if ($conn -> connect_error) { die("Nie połączono z bazą danych: " . $conn -> connect_error);}

		$sql = "SELECT nazwa, opis, opinie_klientow, cena, dostepna_ilosc, producent, rozmiar, zdjecie FROM produkty WHERE id_produkty = $id";
		$result = $conn -> query($sql);
		if ($result -> num_rows > 0)
		{
	 		while($row = $result -> fetch_assoc())
	 		{
	       		echo '<img src="images/products/'.$row["zdjecie"].'" width="150" height="150" alt="product.png"><br>'.$row["nazwa"]." ".$row["rozmiar"].'<br><span style="color:#FF5A00"><b>KUP TERAZ: '.$row["cena"]." PLN</b></span>";
			}
		} else { echo "No results"; }
	}
	
	
	function Show_opinion($id)
	{	
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "sklep";
		require_once "connect.php";
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn -> query("SET NAMES 'utf8'");

		if ($conn -> connect_error) { die("Nie połączono z bazą danych: " . $conn -> connect_error);}
		$sql = "SELECT id_opinie, id_produkty, id_klienci, gwiazdka, opinia FROM opinie WHERE id_opinie = $id";
		$result = $conn -> query($sql);
		if ($result -> num_rows > 0)
		{
	 		while($row = $result -> fetch_assoc())
	 		{
	       		echo '<img src="images/ocena.png"> Komentarz po zakupie: "'.$row["opinia"];
			}
		} else { echo "No results"; }
	}
?> 