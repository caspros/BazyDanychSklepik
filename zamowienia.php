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
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/hamburger.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="(max-width: 800px">

	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link rel="stylesheet" type="text/css" href="css/zamowienia.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
	<link href="fontawesome/css/all.css" rel="stylesheet">
	<title>Moje zamówienia</title>
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
			
			<div id="orders">
				

				<?php
					if($_SESSION['uprawnienia']==1)
					{
						echo '<a id="dodaj_produkt" href="addProduct.php"><h1>Kliknij żeby dodać produkt</h1></a><br><form id="adm_panel" method="POST">

						<b>Admin Panel</b><br><br>

						Id zamówienia: <input class="s_inp" type="text" name="id_zam"/><br><br>
						<input type="hidden" name="paid" value="0" />
						Data wysłania: <input class="s_inp" type="date" name="data_wysl"/><br><br>



						<label><input type="checkbox" name="sent" value="1">  Wysłano</label><br><br>

						<label><input type="checkbox" name="paid" value="1">  Zapłacono</label>
						<input type="hidden" name="sent" value="0" /><br><br>

						<input class="s_inp" type="submit" name="change_status">
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

				<?php
					if($_SESSION['uprawnienia']==0)
					{
						echo '<h1>Moje zamówienia</h1>';
					}
					else
					{
						echo '<h1>Zamówienia klientów</h1>';
					}
				?>

				<br><br>
				<div style="overflow-x:auto;">

				<?php
					Show_orders($id_klienci);
				?>
				</div>
				<br>
			</div>

				<?php
					if($_SESSION['uprawnienia']==0)
					{
						echo '<h1>WYRÓŻNIONE PRODUKTY:</h1>';
					}
				?>

			<!-- PRODUKTY NA GŁÓWNEJ -->
			<div id="products_zam">
				
				<br>

				<?php
					if($_SESSION['uprawnienia']==0)
					{
						echo '<div class="product">';
						Show_product(12);
						echo '</div><div class="product">';
						Show_product(14);
						echo '</div><div class="product">';
						Show_product(8);
						echo '</div><div class="product">';
						Show_product(15);
						echo '</div><div class="product">';
						Show_product(16);
						echo '</div><div class="product">';
						Show_product(17);
						echo '</div>';
						echo '<br>';

					}
				?>
			</div>
			<br><br><br><br><br><br><br><br>
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
			$sql = "SELECT z.id_zamowienia, z.data_zlozenia, z.zaplacono, z.data_wyslania, z.suma FROM zamowienia z, klienci k GROUP BY z.id_zamowienia";
		} 
		else
		{
			$sql = "SELECT z.id_zamowienia, z.data_zlozenia, z.zaplacono, z.data_wyslania, z.suma FROM zamowienia z, klienci k WHERE z.id_klienci = $id_klienci GROUP BY z.id_zamowienia";
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
							<th>Kwota zamówienia</th>
							<th>Status płatności</th>
							<th>Data wysłania</th>
						</tr>';
				while($row = $result -> fetch_assoc())
				{
					echo '<tr>
							<td>'.$row['id_zamowienia'].'</td>
							<td>'.$row['data_zlozenia'].'</td>
							<td>'.$row['suma'].' PLN</td>
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