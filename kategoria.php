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
	<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/hamburger.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="(max-width: 800px">

	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link rel="stylesheet" type="text/css" href="css/kategoria.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
	<link href="fontawesome/css/all.css" rel="stylesheet">
	<title>Kategorie</title>
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
		
			<!-- KATEGORIE -->
			    <div id="centeredmenu">
				   <ul>
				   	<li><a href="kategoria.php?id_kategorie=1">Koszulki</a><br></li>
					<li><a href="kategoria.php?id_kategorie=2">Spodnie</a><br></li>
					<li><a href="kategoria.php?id_kategorie=3">Kubki</a><br></li>
					<li><a href="kategoria.php?id_kategorie=4">Długopisy</a><br></li>
					<li><a href="kategoria.php?id_kategorie=5">Bluzy</a><br></li>
					<li><a href="kategoria.php?id_kategorie=6">Naklejki</a><br></li>
					<li><a href="kategoria.php?id_kategorie=7">Ramki</a><br></li>
					<li><a href="kategoria.php?id_kategorie=8">RTV</a><br></li>
					<li><a href="kategoria.php?id_kategorie=9">AGD</a><br></li>
					<li><a href="kategoria.php?id_kategorie=10">Alkohol</a><br></li>
					<li><a href="kategoria.php?id_kategorie=11">Zabawki</a><br></li>
					<li><a href="kategoria.php?id_kategorie=0">Wszystko</a><br></li>
				   </ul>
				</div>

		<!-- MIĘSO ARMATNIE -->
		<div id="main">
			<?php
				Show_products();
			?>
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
	function Show_products()
	{	
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "sklep";
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn -> query("SET NAMES 'utf8'");
		if ($conn -> connect_error) { die("Nie połączono z bazą danych: " . $conn -> connect_error);}


		// ilośc wyswietlanych produktów na stronę
		$amout = 5;
		if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
		$start_from = ($page-1) * $amout;

		// sprawdzamy czy jest ustawiona kategoria
		if(isset($_GET['id_kategorie']))
		{
			$id_kategorie = $_GET['id_kategorie'];
			if($id_kategorie==0)
			{
				$sql = "SELECT * FROM produkty ORDER BY id_produkty ASC LIMIT $start_from, ".$amout;
				echo '<h1>Wszystkie produkty</h1>';
			}
			else if($id_kategorie>11)
			{
				header('Location: kategoria.php?id_kategorie=0');
				exit();
			}
			else
			{
				$sql = "SELECT * FROM produkty WHERE id_kategorie=$id_kategorie ORDER BY id_produkty ASC LIMIT $start_from, ".$amout;
			}
			$sql1 = "SELECT id_kategorie, kategoria FROM kategorie WHERE id_kategorie=$id_kategorie";
			$result1 = $conn -> query($sql1);
			$row1 = $result1 -> fetch_assoc();
			echo '<h1>'.$row1['kategoria'].'</h1>';
		}
		else
		{
			header('Location: index.php');
			exit();
		}
		
		
		$result = $conn -> query($sql);

		if ($result -> num_rows > 0)
		{
	 		while($row = $result -> fetch_assoc())
	 		{
	 			//>>>>>>>>>>>OFERTA DNIA
				$sql_oferta_dnia = "SELECT poprzednia, id_produkty, data FROM oferta_dnia WHERE id_produkty=".$row["id_produkty"];
				$result_oferta = $conn -> query($sql_oferta_dnia);
				if ($result_oferta -> num_rows > 0)
				{
					while($row_oferta = $result_oferta -> fetch_assoc())
	 				{
	 					$_SESSION['poprzednia'] = $row_oferta['poprzednia'];
	 					$_SESSION['data'] = $row_oferta['data'];
		       		}
				}

				echo '<a href="produkt.php?id_produkty='.$row["id_produkty"].'" id="product_link">
						<div class="product_kat ';

						// DO OFERTY PROMOCYJNEJ 
						if(isset($_SESSION['poprzednia']))
						{
							echo 'oferta_dnia">';
						}
						else
						{
							echo '">';
						}

						echo'<div id="zdjecie">
				       			<img src="images/products/'.$row["zdjecie"].'" width="200" height="200" alt="product.png">
				       		</div>

				       		<div class="zawartosc">

						       			<th colspan="2">
						       				<div class="nazwa">
						       					<b>'.$row["nazwa"].'</b>
						       				</div>
						       			</th><th>';

										// DO OFERTY PROMOCYJNEJ 
						       			if(isset($_SESSION['poprzednia']))
					       				{
						       				echo '<div id="stara_cena">
						       					Stara cena: <s>'.$_SESSION['poprzednia'].' PLN</s>
						       				</div><br>';
						       			}
					       				echo '<div id="cena">';

					       				if(isset($_SESSION['poprzednia']))
				       					{
				       						echo 'Cena po rabacie: '.$row["cena"].' PLN<span id="gwiazdka">*</span></b>';
				       					} else { echo '<b>Cena: '.$row["cena"].' PLN</b>' ;}
					       					
					       				echo '</div><br>';

					       				if(isset($_SESSION['data']))
				       					{
				       						echo '*Oferta ważna do '.substr($_SESSION['data'], 0,10).' lub do wyczerpania zapasów';
				       						unset($_SESSION['poprzednia']);
				       						unset($_SESSION['data']);
				       					}
						       			echo '</th>
						    </div>
						    <div class="zawartosc2">
						       		<tr>
							       		<td>
							       		<div class="rozmiar">Rozmiar: ';
							       		if(is_null($row["rozmiar"]))
							       		{
							       			echo 'Nie dotyczy';
							       		}else echo $row["rozmiar"];
							       		echo '</div></td>
							       		<td><div class="producent">Producent: '.$row['producent'].'</div>
							       		</td><td><span style="color:green;font-style:normal;">Dostawa: '.$row['dostawa'].' PLN</span></td>
						       		</tr>
					       		</table>
				       		</div>				     
		       			</div></a>';
		    }
		}
		else { echo "Brak produktów w podanej kategorii"; }

			if(isset($_GET['id_kategorie']))
			{
				if($id_kategorie==0)
				{
					$sql5 = "SELECT COUNT(id_produkty) AS total FROM produkty";
				}
				else
				{
					$sql5 = "SELECT COUNT(id_produkty) AS total FROM produkty WHERE id_kategorie=$id_kategorie";
				}
				
			}
			else
			{
				$sql5 = "SELECT COUNT(id_produkty) AS total FROM produkty";
			}

			$result5 = $conn->query($sql5);
			$row5 = $result5 -> fetch_assoc();
			$total_pages = ceil($row5["total"] / $amout);
			if($total_pages>1)
			{
				for ($i=1; $i<=$total_pages; $i++)
				{ 
					echo "<div class='strona'><a href='kategoria.php?id_kategorie=".$id_kategorie."&page=".$i."'>".$i."</a></div>";
				}
			}
	}
?>