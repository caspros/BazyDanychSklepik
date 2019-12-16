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
		
		<h1>Najczęściej zadawane pytania:</h1>
		
		<div id="koszyk_container">
				<div id="informacja1">
					<p><strong>Pytanie 1:</strong> Jestem tutaj nowy/(a), gdzie mogę stworzyć sobie konto?</p>
					<p><strong>Odpowiedź 1:</strong>W prawym górnym rogu strony, znajduje się opcja nazwana "Witaj, zaloguj się". Jej kliknięcie spowoduje rozwinięcie menu, które posiada kilka opcji wyboru. Na samym dole listy wyboru znajduje się opcja nazwana "Zaloguj". Po jej wybraniu zostaniesz przeniesiony na nowe okno w którym widnieje formularz "Logowanie". Pod nim natomiast widnieje opcja "Nie posiadasz konta? Zarejestruj się!". Po kilknięciu na nią, zostajesz przeniesiony do formularza "Rejestracja", gdzie po podaniu Imienia, Nazwiska, Emailu, Hasła, akcpetacji regulaminu oraz przyciśnięciu guzika "Zarejestruj", utworzysz nowe konto w naszym serwisie. Otrzymasz komunikat o powodzeniu operacji i możliwość powrotu na stronę główną, gdzie możesz się już zalogować jako urzytkownik serwisu i korzystać z naszych bogatych ofert. W razie problemów z zalogowaniem, zalecamy przeczytanie Pytania Nr. 2. </p>
					<p><strong>Pytanie 2:</strong> Jak się zalogować do Alledrogo?</p>
					<p><strong>Odpowiedź 2:</strong> W prawym górnym rogu strony, znajduje się opcja nazwana "Witaj, zaloguj się". Jej kliknięcie spowoduje rozwinięcie menu, które posiada kilka opcji wyboru. Na samym dole listy wyboru znajduje się opcja nazwana "Zaloguj". Zostaniesz przeniesiony na nowe okno w którym widnieje formularz "Logowanie". Po wpisaniu swojego emaila, hasła i kliknięciu guzika "Zaloguj", strona przeładuje  się i powrócimy na stronę główną Alledrogo. Wówczas będziemy już zalogowani o czym świadczy nas opis w prawym górnym rogu strony "Witaj,"Twoja_nazwa_konta".</p>
					<p><strong>Pytanie 3:</strong> Czy istnieje możliwość zmiany adresu dostawy?</p>
					<p><strong>Odpowiedź 3:</strong> Oczywiście. Jako zalogowany urzytkownik serwisu Alledrogo, dysponujesz możliwością zmiany adresu na który przyjedzie dostawa. Znajduje się ono w Ustawieniach, które jest w ukryte menu wyboru "Witaj,"Twoja_nazwa_konta", które można znaleść w prawym górnym rogu strony. Po wybraniu zakładki "Ustawienia" pojawi sie formularz z naszymi danymi dostawy. Prosimy mieć na uwadze, aby podać dokładną lokalizacje dostawy, aby nie było problemów z brakiem dostawy.</p>
					<p><strong>Pytanie 4:</strong> Gdzie mogę zobaczyć listę produktów, które dodałem/(am) do koszyka?</p>
					<p><strong>Odpowiedź 4:</strong> Wszystkie produkty, które zostały dodane do koszyka, można zobaczyć po kliknięciu w ikonę koszyka w górnej części strony, koło wyszukiwarki produktów. Dla wygody naszych urzytkowników, możliwość wejścia w koszyk, jest dostępna z każdego miejsca naszej strony. Gdy jesteś przekonany/(na) o doborze wybranych produktów i chęci ich nabycia, kliknij przycisk "Załóż zamówienie".</p>
					<p><strong>Pytanie 5:</strong> Chcę ocenić wasz serwis, jest taka możliwość?</p>
					<p><strong>Odpowiedź 5:</strong> Naturalnie. Zalogowani użytkownicy mogą oceniać i zakupione produkty, jak i nasz sklep. Opcję służące do tego znajdują się w menu "Witaj, "Twoja_nazwa_konta". Po kliknięciu interesującej nasz opcji, pojawia się formularz oceny. Będziemy wdzięczni za opinie i komenarze. Najlepsze z nich wyświetlimy na stronie głównej.</p>
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