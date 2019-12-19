<?php
	session_start();
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		$_SESSION['wyloguj'] = "Wyloguj";
		unset($_SESSION['zaloguj']);
		if((isset($_SESSION['uprawnienia'])) && ($_SESSION['uprawnienia']==0))
		{
			header('Location: index.php');
			exit();
		}

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
	<link rel="stylesheet" type="text/css" href="css/menu.css">
		<link rel="stylesheet" type="text/css" href="css/hamburger.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="(max-width: 800px">
	<link rel="stylesheet" type="text/css" href="css/koszyk.css">
	<link rel="stylesheet" type="text/css" href="css/add_product.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
	<link href="fontawesome/css/all.css" rel="stylesheet">
	<title>Dodaj produkt</title>
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
		<div class="login-popup-wrap new_login_popup">
			
			<form action="addingProduct.php" method="post" enctype="multipart/form-data">
				<div class="login-popup-heading text-center">
					Nazwa:<input type="text" name="nazwa"><br><br>
			
					Opis:<br><textarea name="opis" cols="20" rows="5"></textarea><br><br>
				
					Cena:<input type="text" name="cena"><br><br>
				
					Dostępna ilość:<input type="text" name="dostepna_ilosc"><br><br>
			
					Producent:<input type="text" name="producent"><br><br>

					Rozmiar:<input type="text" name="rozmiar"><br><br>

					Cena dostawy:<input type="text" name="dostawa"><br><br>

					Kategoria:
					<select name="kategoria">
						  <option value="1">Koszulki</option>
						  <option value="2">Spodnie</option>
						  <option value="3">Kubki</option>
						  <option value="4">Długopisy</option>
						  <option value="5">Bluzy</option>
						  <option value="6">Naklejki</option>
						  <option value="7">Ramki</option>
						  <option value="8">RTV</option>
						  <option value="9">AGD</option>
						  <option value="10">Alkohol</option>
						  <option value="11">Zabawki</option>
					</select><br><br>

			   			Wybierz zdjęcie do dodania: <br><input type="file" name="myfile"><br><br>
					<input name="submit" class="btn btn-default login-popup-btn" type=submit value="Dodaj">
				</div>
			</form>
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
	<!-- STICKY MENU JS-->
	<script src="js/sticky_menu.js"></script>
	<!-- STICKY MENU WITAJ ZALOGUJ SIĘ JS-->
	<script src="js/dropdown_sticky.js"></script>
	<!-- SLIDER JS-->
	<script src="js/slider.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
</body>
</html>

