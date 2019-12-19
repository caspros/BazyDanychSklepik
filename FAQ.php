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
	<link rel="stylesheet" type="text/css" href="css/koszyk.css">
		<link rel="stylesheet" type="text/css" href="css/hamburger.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="(max-width: 800px">

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
	<link href="fontawesome/css/all.css" rel="stylesheet">
	<title>Najczęściej zadawane pytania</title>
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
		
		<h1>Najczęściej zadawane pytania:</h1>
		
		<div id="FAQ_container">
				<div id="FAQ">
					<br><br>
					<details>
					    <summary><strong>Pytanie 1:</strong> Jestem tutaj nowy/(a), gdzie mogę stworzyć sobie konto?</summary>
					    <br><strong>Odpowiedź 1:</strong> W prawym górnym rogu strony, znajduje się opcja nazwana "Zaloguj się". Po jej wybraniu zostaniesz przeniesiony na nowe okno w którym widnieje formularz "Logowanie". Pod nim natomiast widnieje opcja "Nie posiadasz konta? Zarejestruj się!". Po kilknięciu na nią, zostajesz przeniesiony do formularza "Rejestracja", gdzie po podaniu Imienia, Nazwiska, Emailu, Hasła, akcpetacji regulaminu oraz przyciśnięciu guzika "Zarejestruj", utworzysz nowe konto w naszym serwisie. Otrzymasz komunikat o powodzeniu operacji i możliwość powrotu na stronę główną, gdzie możesz się już zalogować jako użytkownik serwisu i korzystać z naszych bogatych ofert. W razie problemów z zalogowaniem, zalecamy przeczytanie Pytania Nr. 2. 
					</details>

					<br><br>
					
					<details>
					    <summary><strong>Pytanie 2:</strong> Jak się zalogować do Alledrogo?</summary>
					<br><strong>Odpowiedź 2:</strong> W prawym górnym rogu strony, znajduje się opcja nazwana "Zaloguj się". Jej kliknięcie spowoduje przeniesienie na nowe okno w którym widnieje formularz "Logowanie". Po wpisaniu swojego emaila, hasła i kliknięciu guzika "Zaloguj", strona przeładuje się i powrócimy na stronę główną Alledrogo. Wówczas będziesz już zalogowany o czym świadczy opis w prawym górnym rogu strony "Wyloguj".
					</details>

					<br><br>

					<details>
					    <summary><strong>Pytanie 3:</strong> Czy istnieje możliwość zmiany adresu dostawy?</summary>
					<br><strong>Odpowiedź 3:</strong> Oczywiście. Jako zalogowany użytkownik serwisu Alledrogo, dysponujesz możliwością zmiany adresu na który przyjedzie dostawa. Znajduje się ono w Ustawieniach, które można znaleść w górnej części strony. Po wybraniu zakładki "Ustawienia" pojawi sie formularz z naszymi danymi dostawy. Prosimy mieć na uwadze, aby podać dokładną lokalizacje dostawy, aby nie było problemów z brakiem dostawy.
					</details>

					<br><br>


					<details>
					    <summary><strong>Pytanie 4:</strong> Gdzie mogę zobaczyć listę produktów, które dodałem/(am) do koszyka?</summary>
					<br><strong>Odpowiedź 4:</strong> Wszystkie produkty, które zostały dodane do koszyka, można zobaczyć po kliknięciu w opcję "Koszyk" w górnej części strony, koło opcji "Wyloguj". Dla wygody naszych użytkowników, możliwość wejścia w koszyk, jest dostępna z każdego miejsca naszej strony. Gdy jesteś przekonany/(na) o doborze wybranych produktów i chęci ich nabycia, kliknij przycisk "Załóż zamówienie".
					</details>

					<br><br>

					<details>
					    <summary><strong>Pytanie 5:</strong> Chcę ocenić wasz serwis, jest taka możliwość?</summary>
					<br><strong>Odpowiedź 5:</strong> Naturalnie. Zalogowani użytkownicy mogą oceniać i zakupione produkty, jak i nasz sklep. Opcję służące do tego znajdują się w menu w górnej części strony. Po kliknięciu interesującej nasz opcji, pojawia się formularz oceny. Będziemy wdzięczni za opinie i komenarze. Najlepsze z nich wyświetlimy na stronie głównej.
					</details>

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