<!DOCTYPE HTML>
<html lang="pl">

<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/koszyk.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
	<link href="fontawesome/css/all.css" rel="stylesheet">
	<title>Ocena sklepu</title>
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
	<div id="container_koszyk">
		
		<h1>Regulamin alledrogo:</h1>
		
		<div id="koszyk_container">
				<div id="informacja1">
					<a href="regulamineng.php">English version</a><br><br>
<h3>PRYWATNOŚĆ I POUFNOŚĆ</h3><br>

<p>1.Dane osobowe podane przez Użytkowników w miejscach do tego przeznaczonych, Alledrogo przetwarza zgodnie z obowiązującymi przepisami prawa oraz zgodnie z polityką prywatności.</p><br>

<p>2.Użytkownikom ujawniane są dane osobowe innych Użytkowników jedynie w przypadkach przewidzianych w Regulaminie w celach związanych z przeprowadzaniem Transakcji oraz w innych przypadkach, za uprzednią zgodą osoby, której dane dotyczą.</p><br>

<p>3.Użytkownik zobowiązany jest nie ujawniać osobom trzecim informacji dotyczących innych Użytkowników, które otrzymał od Alledrogo w związku z korzystaniem z Alledrogo, chyba że uzyskał uprzednią zgodę od Użytkownika, którego dane dotyczą. W szczególności zabronione jest wykorzystywanie przedmiotowych informacji w celach komercyjnych polegających, w szczególności na promowaniu w jakiejkolwiek formie działalności Użytkownika prowadzonej poza Alledrogo.</p><br>

<p>4.Zabronione jest wykorzystywanie informacji, o których mowa w art. 3, w celach komercyjnych polegających na promowaniu w jakiejkolwiek postaci działalności Użytkownika prowadzonej poza Alledrogo. W szczególności zabronione jest:</p>

<p>a) składanie propozycji zakupu lub sprzedaży Towaru poza Alledrogo;</p>

<p>b) dołączanie do wysyłanego Towaru lub dostarczanie w jakiejkolwiek innej formie treści zawierających informację o działalnościkomercyjnej prowadzonej poza Alledrogo (na przykład ulotek reklamujących sklep internetowy);</p>

<p>c) zakładanie Użytkownikom kont w sklepach internetowych.</p><br>

<p>5.Alledrogo zastrzega sobie prawo do filtrowania i zatrzymywania wiadomości wysyłanych przez Użytkowników w ramach narzędzi udostępnionych w Alledrogo, w szczególności jeśli mają charakter spamu, zawierają treści naruszające niniejszy Regulamin lub w inny sposób zagrażają bezpieczeństwu Użytkowników.</p><br>

<p>6.Zakończone Oferty mogą być publikowane w subdomenie archiwum.alledrogo.pl. Publikowane informacje mają jedynie charakter poglądowy, a Alledrogo nie zapewnia i nie gwarantuje pełnego oraz kompleksowego upubliczniania informacji o zakończonych Ofertach.</p><br>


				</div>
			<br><br>
			
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
	
</body>
</html>