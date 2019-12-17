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
		
		<h1>Oceń nas</h1>


		<!-- MIĘSO ARMATNIE -->
		<div id="koszyk_container">
				<div id="informacja1">
					Każda pozostawiona opinia klienta jest dla nas bardzo cenna. <br>
					Dzięki Waszym opiniom stale możemy ulepszać jakość naszych usług.
				</div>
			<br><br>

			<?php
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "sklep";
				$conn = new mysqli($servername, $username, $password, $dbname);
				$conn -> query("SET NAMES 'utf8'");
				if ($conn -> connect_error) {die("Nie połączono z bazą danych: " . $conn -> connect_error);}
				$id_klienci = $_SESSION['id_klienci'];
				$_SESSION['juz_oceniono'] = FALSE;
				$sql = "SELECT * FROM opinie WHERE id_klienci=$id_klienci";
				$result = $conn -> query($sql);
				while($row = $result -> fetch_assoc())
				{
					if($row['id_produkty']==0)
					{
						$_SESSION['juz_oceniono'] = TRUE;
					}
				}

				if((isset($_SESSION['juz_oceniono'])) && ($_SESSION['juz_oceniono']==TRUE))
				{
					$sql1 = "SELECT * FROM opinie WHERE id_klienci=$id_klienci and id_produkty=0";
					$result1 = @$conn -> query($sql1);
					if ($result -> num_rows > 0)
					{
						if($row1 = $result1 -> fetch_assoc())
						{
							echo '<h2>Już oceniłeś nasz sklep, dziękujemy!</h2><br>';
							echo '<div id="dziekujemy">Twoja ocena: <b>'.$row1['gwiazdka'].'/10</b><br>';
							echo 'Twoj komentarz: <b>'.$row1['opinia'].'</b></div>';
						}
					}
				}
				else
				{
					echo '<div id="formularz">
							<form action="addingOcena.php" method="post">
								Ocena: 
								<select name="ocena">
								  <option value="1">1</option>
								  <option value="2">2</option>
								  <option value="3">3</option>
								  <option value="4">4</option>
								  <option value="5">5</option>
								  <option value="6">6</option>
								  <option value="7">7</option>
								  <option value="8">8</option>
								  <option value="9">9</option>
								  <option value="10">10</option>
								</select>

								<br><span id="koment">Komentarz:</span><br>
								<textarea name="opis" cols="50" rows="3"></textarea><br><br>
								<input name="submit" id="dalej_btn" type=submit value="Dodaj">
							</form>
						</div>';
				}

			?>

			
			



			<br><br><br><br><br><br><br><br><br>
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
	
</body>
</html>