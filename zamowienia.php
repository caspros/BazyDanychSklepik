<?php
	session_start();

	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		$id_klienci = $_SESSION['id_klienci'];
		$_SESSION['wyloguj'] = "Wyloguj";
		unset($_SESSION['zaloguj']);
	} else {
		$_SESSION['zaloguj'] = "Zaloguj";
		unset($_SESSION['wyloguj']);
		header('Location: index.php');
	}
?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
	<link href="fontawesome/css/all.css" rel="stylesheet">
	<title>Moje zamówienia</title>
</head>

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
		    		<a href="zamowienia.php">Moje zamówienia</a>
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
	
	<!-- GŁÓWNY CONTAINER -->
	<div id="container">

		<!-- MIĘSO ARMATNIE -->
		<div id="main">
			

			<!-- KATEGORIE -->
			<div id="categories">
				<br>

				<span class="kat"><b>Kategorie:</b></span>
				<br><br>
				<a href="#">Koszulki</a><br>
				<a href="#">Spodnie</a><br>
				<a href="#">Kubki</a><br>
				<a href="#">Długopisy</a><br>
				<a href="#">Bluzy</a><br>
				<a href="#">Naklejki</a><br>
				<a href="#">Ramki</a><br>
				<a href="#">RTV</a><br>
				<a href="#">AGD</a><br>
				<a href="#">Alkohol</a><br>
				<a href="#">Zabawki</a><br>

			</div>

			<div id="orders">
				

				<?php
					if($_SESSION['uprawnienia']==1)
					{
						echo '<form id="adm_panel" method="POST">
						<b>Admin Panel</b><br><br>
						Id zamówienia: <input type="text" name="id_zam"/><br><br>
						<input type="hidden" name="paid" value="0" />
						<label><input type="checkbox" name="paid" value="1">Zapłacono</label>
						<input type="hidden" name="sent" value="0" />
						<label><input type="checkbox" name="sent" value="1">Wysłano</label><br><br>
						Data wysłania: <input type="date" name="data_wysl"/>
						<input type="submit" name="change_status">
						</form>
						<br>';

						if(isset($_POST['id_zam']))
						{
							$id_zam=$_POST['id_zam'];
							$status=$_POST['paid'];
							$data=$_POST['data_wysl'];
							$status_wysyl=$_POST['sent'];
							require_once "connect.php";
							$conn = new mysqli($servername, $username, $password, $dbname);
							$conn -> query("SET NAMES 'utf8'");
							if ($conn -> connect_error) {die("Nie połączono z bazą danych: " . $conn -> connect_error);}
							$sql = "UPDATE zamowienia SET zaplacono=$status WHERE id_zamowienia=$id_zam";
							$result = $conn -> query($sql);
							if($status_wysyl)
							{
								$sql = "UPDATE zamowienia SET data_wyslania='$data' WHERE id_zamowienia=$id_zam";
								$result = $conn -> query($sql);
							}
							else
							{
								$sql = "UPDATE zamowienia SET data_wyslania='0000-00-00' WHERE id_zamowienia=$id_zam";
								$result = $conn -> query($sql);
							}
						}
					}
				?>

				<h3 id="title3">Moje zamówienia</h3>
				<?php
					Show_orders($id_klienci);
				?>

			</div>

			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				<h1>WYRÓŻNIONE PRODUKTY:</h1>
			<!-- PRODUKTY NA GŁÓWNEJ -->
			<div id="products">
				
				<br>
				<div class="product"><?php Show_product(12);?></div>
				<div class="product"><?php Show_product(14);?></div>
				<div class="product"><?php Show_product(8);?></div>
				<div class="product"><?php Show_product(15);?></div>
				<div class="product"><?php Show_product(16);?></div>
				<div class="product"><?php Show_product(17);?></div>

			</div>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		</div>

		

	</div>

    <div id="centeredmenu">
	   <ul>
	      <li><a href="#">FAQ</a></li>
	      <li><a href="#">Kontakt</a></li>
	      <li><a href="#">Regulamin</a></li>
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
</body>
</html>

<!--- PHP DO SHOW_ORDERS --->
<?php
	function Show_orders($id)
	{
		require_once "connect.php";
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "sklep";
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn -> query("SET NAMES 'utf8'");

		// Check connection
		if ($conn -> connect_error) {
		    die("Nie połączono z bazą danych: " . $conn -> connect_error);
		}

		$id_klienci = $_SESSION['id_klienci'];

		$sql_adm="SELECT uprawnienia FROM klienci WHERE id_klienci = $id_klienci";
		$result_adm = $conn -> query($sql_adm);
		$row_adm = $result_adm -> fetch_assoc();
		if($row_adm['uprawnienia'])
		{
			$sql = "SELECT z.id_zamowienia, z.data_zlozenia, z.zaplacono, z.data_wyslania FROM zamowienia z, klienci k GROUP BY z.id_zamowienia";
		} 
		else
		{
			$sql = "SELECT z.id_zamowienia, z.data_zlozenia, z.zaplacono, z.data_wyslania FROM zamowienia z, klienci k WHERE z.id_klienci = $id_klienci GROUP BY z.id_zamowienia";
		}
		$result = $conn -> query($sql);
		if(mysqli_num_rows($result)==0)
		{
			echo '<span class="no_orders">Brak zamówień</span>';
		} 
		else {
				echo '<table class="order_table">
						<tr>
							<th>Id zamówienia</th>
							<th>Data zamówienia</th>
							<th>Status płatności</th>
							<th>Data wysłania</th>
						</tr>';
				while($row = $result -> fetch_assoc())
				{
					echo '<tr>
							<td>'.$row['id_zamowienia'].'</td>
							<td>'.$row['data_zlozenia'].'</td>
							<td>';
							if($row['zaplacono']==0)
							{
								echo 'Oczekiwanie na zapłatę</td>';
							} else {echo'Zapłacono</td>';};
							echo '<td>';
							if($row['data_wyslania']=="0000-00-00")
							{
								if($row['zaplacono']==0)
								{
									echo 'Oczekiwanie na zapłatę';
								} else {
									echo 'Zamówienie gotowe do wysłania';
								}
							}else echo $row['data_wyslania'];
							echo '</td>
						</tr>';						
				}
				echo '</table>';
			}
	}
?>

<!--- PHP DO SHOW_PRODUCT --->
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
?> 