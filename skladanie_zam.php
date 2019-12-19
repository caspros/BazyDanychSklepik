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
	<title>Twój koszyk</title>
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
			<h2>Adres do wysyłki: </h2><br>
			<?php
				Show_address();
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
	

	//Function to show products in categories
	function Show_address()
	{	
		$id_klienci = $_SESSION['id_klienci'];
		$suma = $_SESSION['suma'];
		$max_dostawa = $_SESSION['max_dostawa'];
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
		$sql = "SELECT * FROM adres WHERE id_klienci= '$id_klienci'";
		$result = $conn -> query($sql);
		//Czy jest adres
		if ($result -> num_rows > 0)
		{
			$row = $result -> fetch_assoc();
			if($row['miasto']===NULL)
			{
				echo '<div id="adres">Aktualnie nie masz ustawionego adresu wysyłki.<br>
				Ustaw swój adres w <a class="ustawienia_link" href="profil.php">Ustawieniach</a>
				</div>';
			}
			else
			{
			echo '<div id="adres">Paczka zostanie wysłana na adres: <br><br><b>'.$row['kod_pocztowy'].' '.$row['miasto'].'<br>ul. '.$row['ulica'].' '.$row['nr_domu'].'/'.$row['nr_lokalu'].'</b><br><br>
			Jeśli chcesz aby paczka została wysłana na inny adres, zmień swój adres w <a class="ustawienia_link" href="profil.php">Ustawieniach</a>
			<br><br><br><br>
			<form method="post" action="skladanie_zam_next.php">
				<input type="hidden" name="next" value="'.$suma.'"/>
				<input type="hidden" name="next1" value="'.$max_dostawa.'"/>
				<button type="submit" id="dalej_btn">Dalej</button>
			</form></div>';
			}
			
		}
	}
?>