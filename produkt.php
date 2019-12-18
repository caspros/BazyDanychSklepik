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
	<link rel="stylesheet" type="text/css" href="css/hamburger.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link rel="stylesheet" type="text/css" href="css/produkt.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
	<link href="fontawesome/css/all.css" rel="stylesheet">
	<title>Produkt</title>
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

				$sql = "SELECT nazwa, opis, opinie_klientow, cena, dostepna_ilosc, producent, rozmiar, zdjecie, dostawa FROM produkty WHERE id_produkty=$id_produktu";
				$result = $conn -> query($sql);
				Show_product($id_produktu);
			?>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			
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

	<script src="http://code.jquery.com/jquery-1.7.1.js"></script>
	<!-- JQUERY -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<!-- STICKY MENU JS-->
	<script src="js/sticky_menu.js"></script>
	<!-- STICKY MENU WITAJ ZALOGUJ SIĘ JS-->
	<script src="js/dropdown_sticky.js"></script>
	<!-- SLIDER JS-->
	<script src="js/slider.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- PRICE CHANGING WHILE INCREASE AMOUT OF PRODUCT-->
	<script type="text/javascript">
			var cookies = document.cookie.split(";").
   			map(function(el){ return el.split("="); }).
    		reduce(function(prev,cur){ prev[cur[0]] = cur[1];return prev },{});
			
				$('#ile_sztuk').on('change paste', function () {
				    $("#current").html($(this).val()*cookies["MyCookie"]);
				});      
	</script>

<?php
	//Function to show product on main site
	function Show_product($id)
	{	
		$id_produktu = $_GET['id_produkty'];
		require_once "connect.php";
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn -> query("SET NAMES 'utf8'");
		if ($conn -> connect_error) { die("Nie połączono z bazą danych: " . $conn -> connect_error);}

		$sql = "SELECT id_produkty, nazwa, opis, opinie_klientow, cena, dostepna_ilosc, producent, rozmiar, zdjecie, dostawa FROM produkty WHERE id_produkty=$id_produktu";
		$result = $conn -> query($sql);
		if ($result -> num_rows > 0)
		{
	 		while($row = $result -> fetch_assoc())
	 		{	
	 			$_SESSION['cena']=$row["cena"];
	 			$_SESSION['produkt']=$row["id_produkty"];
	 			setcookie("MyCookie", $row["cena"]);
	       		echo '<div id="produkt_big"><img src="images/products/'.$row["zdjecie"].'" width="500" height="500" alt="product.png"><br><b>'
			       		.$row["nazwa"].'</b><br><br>Specyfikacja produktu<br><br>
			       		<div id="dane">Rozmiar: ';
				       		if(is_null($row["rozmiar"]))
				       		{
				       			echo 'Nie dotyczy';
				       		}else echo $row["rozmiar"];
				       		echo '<br>Producent: '.$row["producent"].
			       		'</div>
			       		<br><br>Opis produktu: <br>'.$row["opis"].
			       		'<br><br><form action="koszyk.php" method="post"><input type="number" id="ile_sztuk" name="ile_sztuk" value="1" min="1" max='.$row["dostepna_ilosc"].'> z <b>'.$row["dostepna_ilosc"].' sztuk</b>'.
			       		'<input id="dostawa1" type="hidden" name="koszyk1" value='.$row['dostawa'].'/><br><br><button type="submit" id="kup_teraz"><span style="color:white"><b>KUP TERAZ:  <span id="current">'.$row["cena"].'</span> PLN</b></span></button><br>
			       			<span style="color:green;">+ Dostawa: <span id="dostawa">'.$row['dostawa'].'</span> PLN</span>
			       		</form>
	       			</div>';
			}
		} else { echo "No results"; }
	}

	
				
?>


<script>
	// do input dodac onchange="myFunction()
//Funkcja na zliczanie dostawy 
/*function myFunction()
{
	  var x = document.getElementById("ile_sztuk");
	  //var dostawa = document.getElementById("dostawa1").value;

	  var currentVal = x.value;
	  if (currentVal % 5 == 1)
	  {
	    document.getElementById("dostawa").innerHTML = 12 + ((currentVal - 1) / 5) * 12;
	    
	  }

	if (currentVal % 5 == 0)
    {
    	document.getElementById("dostawa").innerHTML = 12 + (((currentVal) / 5) -1) * 12;
    }
}*/
</script>
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


