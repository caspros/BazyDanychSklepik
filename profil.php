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
	$id_klienci = $_SESSION['id_klienci'];

	

	//Testowe do wyswietlania z bazy danych w polach
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "sklep";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn -> query("SET NAMES 'utf8'");
	if ($conn -> connect_error) { die("Nie połączono z bazą danych: " . $conn -> connect_error);}
	$sql = "SELECT * FROM adres WHERE id_klienci='$id_klienci'";
	if($result = @$conn->query($sql))
	{
		$row = $result -> fetch_assoc();
		$u = $row['ulica'];
		$k = $row['kod_pocztowy'];
		$m = $row['miasto'];
		$d = $row['nr_domu'];
		$l = $row['nr_lokalu'];

		if($row['miasto']===NULL)
		{
			$u = " ";
			$k = " ";
			$m = " ";
			$d = " ";
			$l = " ";
		}
	}

	//na razie poprawnosc zakomentowana, trzeba poprawić, bo nie działa
	if(isset($_POST['ustawiono']))
	{	
		$wszystko_OK=true;
		$sprawdz = '/^[A-ZŁŚ]{1}+[a-ząęółśżźćń]+$/';
		//poprawność miasta
		$miasto = $_POST['miasto'];
		if(!(preg_match($sprawdz, $miasto)))
		{
			$wszystko_OK=false;
			$_SESSION['e_miasto']="Podaj poprawną miejscowość";
		}

		if(empty($_POST['miasto']))
		{
			$wszystko_OK=false;
			$_SESSION['e_miasto']="Musisz wypełnić wszystkie pola";
		}

		//poprawność ulicy
		$ulica = $_POST['ulica'];
		if(!(preg_match($sprawdz, $ulica)))
		{
			$wszystko_OK=false;
			$_SESSION['e_ulica']="Podaj poprawną ulice";
		}

		if(empty($_POST['ulica']))
		{
			$wszystko_OK=false;
			$_SESSION['e_ulica']="Musisz wypełnić wszystkie pola";
		}
		//poprawność numeru domu
		$sprawdz = '/^[0-99999]*$/';
		$nr = $_POST['nr'];
		if(!(preg_match($sprawdz, $nr)))
		{
			$wszystko_OK=false;
			$_SESSION['e_nr']="Podaj poprawny numer domu";
		}

		if(empty($_POST['nr']))
		{
			$wszystko_OK=false;
			$_SESSION['e_nr']="Musisz wypełnić wszystkie pola";
		}

		//poprawność numeru domu
		$nrm = $_POST['nrm'];
		if(!(preg_match($sprawdz, $nrm)))
		{
			$wszystko_OK=false;
			$_SESSION['e_nrm']="Podaj poprawny numer mieszkania";
		}

		if(empty($_POST['nrm']))
		{
			$wszystko_OK=false;
			$_SESSION['e_nrm']="Musisz wypełnić wszystkie pola";
		}

		//poprawność kodu pocztowego
		$sprawdz = '/^[0-9]{2}-?[0-9]{3}$/Du';
		$zipcode = $_POST['zipcode'];
		if(!(preg_match($sprawdz, $zipcode)))
		{
			$wszystko_OK=false;
			$_SESSION['e_zipcode']="Podaj poprawny kod pocztowy";
		}

		if(empty($_POST['zipcode']))
		{
			$wszystko_OK=false;
			$_SESSION['e_zipcode']="Musisz wypełnić wszystkie pola";
		}

		if($wszystko_OK==true)
		{
			
			//wszystko dobrze dane zapisane
			$sql = "UPDATE adres SET kod_pocztowy = '$zipcode', miasto = '$miasto', ulica = '$ulica', nr_domu = '$nr', nr_lokalu = '$nrm' WHERE id_klienci='$id_klienci'";
			
			if($conn->query($sql))
			{
				unset($_POST['miasto']);
				unset($_POST['ulica']);
				unset($_POST['nr']);
				unset($_POST['nrm']);
				unset($_POST['zipcode']);
				$_SESSION['udanedanezamieszkania']= "Twoje dane zostały zmienione!";
				header( "refresh:2;url=profil.php" );
			}
			else
			{
				throw new Exception($conn->error);
			}		
			$conn->close();
		}

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
	<link rel="stylesheet" href="css/profil.css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="fontawesome/css/all.css" rel="stylesheet">
	<style>
		.error
		{
			color:red;
			margin-top: 10px;
			margin-bottom: 10px;
		}
	</style>
	<title>Dane profilu</title>
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
		    		<a href="zamowienia.php">Moje zamówienia</a>
					<a href="#">Oceń produkt</a>
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
	<div id="container">
		<!-- MIĘSO ARMATNIE -->
		<div id="main">
			
			<div class="login-popup-wrap new_login_popup"> 
				<div id="container_dane">
					<?php
						if (isset($_SESSION['udanedanezamieszkania']))
						{
							//echo "<meta http-equiv='refresh' content='0'>";
							echo '<div class="error">'.$_SESSION['udanedanezamieszkania'].'</div>';
							unset($_SESSION['udanedanezamieszkania']);
						}

						$sql = "SELECT * FROM adres WHERE id_klienci='$id_klienci'";
						if(@$result = $conn->query($sql))
						{

							$row = $result -> fetch_assoc();
							$u = $row['ulica'];
							$k = $row['kod_pocztowy'];
							$m = $row['miasto'];
							$d = $row['nr_domu'];
							$l = $row['nr_lokalu'];
		
							
							if($row['miasto']===NULL)
							{
								$u = " ";
								$k = " ";
								$m = " ";
								$d = " ";
								$l = " ";
							}											
						}
					?>
					<form action="#" method="post">
						<div class="login-popup-heading text-center">
					    	<h4><i class="fa fa-lock" aria-hidden="true"></i> Dane do wysyłki </h4>                        
					    </div>
						<div class="form-group">
							Ulica: <br/> <input type="text" class="form-control" name="ulica" id="ulica" value="<?php echo $u;?>"/>
						</div>
						<?php
							if (isset($_SESSION['e_ulica']))
							{
								echo '<div class="error">'.$_SESSION['e_ulica'].'</div>';
								unset($_SESSION['e_ulica']);
							}
						?>
						<br>
						<div class="form-group">
							Numer domu: <br/> <input type="text" class="form-control" name="nr" id="nr_domu" value="<?php echo $d;?>"/>
						</div>
						<?php
							if (isset($_SESSION['e_nr']))
							{
								echo '<div class="error">'.$_SESSION['e_nr'].'</div>';
								unset($_SESSION['e_nr']);
							}
						?>
						<br>
						<div class="form-group">
							Numer mieszkania: <br/> <input type="text" class="form-control" name="nrm" id="nr_lokalu" value="<?php echo $l;?>"/>
						</div>
						<?php
							if (isset($_SESSION['e_nrm']))
							{
								echo '<div class="error">'.$_SESSION['e_nrm'].'</div>';
								unset($_SESSION['e_nrm']);
							}
						?>
						<br>
						<div class="form-group">	
							Kod pocztowy: <br/> <input type="text" class="form-control" name="zipcode" id="kod_pocztowy" value="<?php echo $k;?>"/>
						</div>
						<?php
							if (isset($_SESSION['e_zipcode']))
							{
								echo '<div class="error">'.$_SESSION['e_zipcode'].'</div>';
								unset($_SESSION['e_zipcode']);
							}
						?>
						<br>
						<div class="form-group">        
								Miasto: <br/> <input type="text" class="form-control" name="miasto" id="miasto" value="<?php echo $m;?>"/>
							</div>
							<?php
								if (isset($_SESSION['e_miasto']))
								{
									echo '<div class="error">'.$_SESSION['e_miasto'].'</div>';
									unset($_SESSION['e_miasto']);
								}
							?>
						<br>
						<input type="hidden" name="ustawiono"/>
						<button type="submit" class="btn btn-default login-popup-btn " id="ustaw_dane_btn" name="submit">Zapisz</button>
					</form>
				</div>
			</div>		
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