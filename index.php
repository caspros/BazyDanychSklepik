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
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
	<link href="fontawesome/css/all.css" rel="stylesheet">
	<title>Alledrogo</title>
</head>

<body>
	<!-- STICKY MENU -->
	<div id="sticky_menu">
		<ol>
			<!-- logo alledrogo -->
			<li>
				<a href="#">
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
				<a href="#">
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
		    		<a href="#">Moje zamówienia</a>
					<a href="#">Oceń produkt</a>
					<a href="#">Ustawienia</a>
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

	<!-- MENU -->
	<div id="menu">
		<ul>	
			<!-- DROPDOWN KATEGORIE -->
			<div class="dropdown_kat">
				<li>
					<div id="myBtn_kat" class="dropbtn_kat">
						Kategorie
					</div>
				</li>
				<div id="myDropdown_kat" class="dropdown-content_kat">
			    	<a href="#">Koszulki</a>
					<a href="#">Spodnie</a>
					<a href="#">Kubki</a>
					<a href="#">Długopisy</a>
	  			</div>
			</div>

				<li><a href="#">Promocje</a></li>
				<li><a href="#">Oferty dnia</a></li>
				<li><a href="#">FAQ</a></li>
			</ul> 	
		</div>
			
	<!-- GŁÓWNY CONTAINER -->
	<div id="container">

		<!-- MIĘSO ARMATNIE -->
		<div id="main">
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
				echo "Połączono z bazą danych";

				$sql = "SELECT nazwa, opis, opinie_klientow, cena, dostepna_ilosc, producent, rozmiar FROM produkty";
				$result = $conn -> query($sql);

			// Output data of each row
				if ($result -> num_rows > 0) {
			 		while($row = $result -> fetch_assoc()) {
			       		echo "<br>Nazwa produktu: "	.$row["nazwa"]. 
			       			"<br>Opis produktu: "	.$row["opis"].
			       			"<br>Opinia klientow: "	.$row["opinie_klientow"].
			       			"<br>Cena [PLN]: "		.$row["cena"].
			       			"<br>Dostępna ilość: "	.$row["dostepna_ilosc"].
			       			"<br>Producent: "		.$row["producent"].
			       			"<br>Rozmiar: "			.$row["rozmiar"];
					}
				} else {
				    echo "No results";
				}

				$conn -> close();
			?>

			<br><br>

			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur risus neque, porttitor eu malesuada a, pulvinar quis quam. Cras sed mi sed tellus finibus posuere. Etiam purus urna, pharetra nec malesuada eu, vehicula ut sem. Donec bibendum ultrices erat quis malesuada. Sed sit amet lectus ut odio tempus dignissim id sit amet quam. Nulla elit erat, imperdiet nec tempus eu, consectetur in quam. Pellentesque in posuere arcu, et imperdiet lorem. Vestibulum faucibus mollis lacus, et maximus arcu fermentum nec. In hac habitasse platea dictumst. Maecenas ut mi tellus. Fusce euismod mollis risus, blandit blandit ex.</p>

			<p>Aenean vitae risus velit. Curabitur placerat, nibh a vulputate fermentum, eros leo finibus mauris, ullamcorper tempor enim dui ultricies sapien. Nunc commodo dapibus mi quis ultricies. Phasellus ornare dolor eget tortor placerat, commodo dictum velit sollicitudin. Sed non hendrerit odio, sed ornare ligula. Donec mattis quis erat nec imperdiet. Pellentesque vehicula sagittis scelerisque.</p>

			<p>Aenean vitae risus velit. Curabitur placerat, nibh a vulputate fermentum, eros leo finibus mauris, ullamcorper tempor enim dui ultricies sapien. Nunc commodo dapibus mi quis ultricies. Phasellus ornare dolor eget tortor placerat, commodo dictum velit sollicitudin. Sed non hendrerit odio, sed ornare ligula. Donec mattis quis erat nec imperdiet. Pellentesque vehicula sagittis scelerisque.</p>

			<p>Aenean vitae risus velit. Curabitur placerat, nibh a vulputate fermentum, eros leo finibus mauris, ullamcorper tempor enim dui ultricies sapien. Nunc commodo dapibus mi quis ultricies. Phasellus ornare dolor eget tortor placerat, commodo dictum velit sollicitudin. Sed non hendrerit odio, sed ornare ligula. Donec mattis quis erat nec imperdiet. Pellentesque vehicula sagittis scelerisque.</p>

			<p>Aenean vitae risus velit. Curabitur placerat, nibh a vulputate fermentum, eros leo finibus mauris, ullamcorper tempor enim dui ultricies sapien. Nunc commodo dapibus mi quis ultricies. Phasellus ornare dolor eget tortor placerat, commodo dictum velit sollicitudin. Sed non hendrerit odio, sed ornare ligula. Donec mattis quis erat nec imperdiet. Pellentesque vehicula sagittis scelerisque.</p>

			<p>Aenean vitae risus velit. Curabitur placerat, nibh a vulputate fermentum, eros leo finibus mauris, ullamcorper tempor enim dui ultricies sapien. Nunc commodo dapibus mi quis ultricies. Phasellus ornare dolor eget tortor placerat, commodo dictum velit sollicitudin. Sed non hendrerit odio, sed ornare ligula. Donec mattis quis erat nec imperdiet. Pellentesque vehicula sagittis scelerisque.</p>

			<p>Aenean vitae risus velit. Curabitur placerat, nibh a vulputate fermentum, eros leo finibus mauris, ullamcorper tempor enim dui ultricies sapien. Nunc commodo dapibus mi quis ultricies. Phasellus ornare dolor eget tortor placerat, commodo dictum velit sollicitudin. Sed non hendrerit odio, sed ornare ligula. Donec mattis quis erat nec imperdiet. Pellentesque vehicula sagittis scelerisque.</p>
		</div>

		<!-- JQUERY -->
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<!-- STICKY MENU JS-->
		<script src="js/sticky_menu.js"></script>
		<!-- STICKY MENU WITAJ ZALOGUJ SIĘ JS-->
		<script src="js/dropdown_sticky.js"></script>
		<!-- KATEGORIE DROPDOWN JS-->
		<script src="js/dropdown_kategorie.js"></script>
	</div>

	<div id="footer">
		Korzystanie z serwisu oznacza akceptację
		<a href="#">
			regulaminu
		</a>
	</div>	
	
</body>
</html>