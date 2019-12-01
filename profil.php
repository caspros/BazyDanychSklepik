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
	//poprawność kodu pocztowego
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
			if($polaczenie->query("INSERT INTO klienci(Miasto, Ulica, nr, nrm, zipcode) VALUES ('$miasto', '$ulica' ,'$nr','$nrm','$zipcode')"))
			{
				unset($_POST['miasto']);
				unset($_POST['ulica']);
				unset($_POST['nr']);
				unset($_POST['nrm']);
				unset($_POST['zipcode']);
				$_SESSION['udanedanezamieszkania']=true;
				header('Location: witamy.php');
			}
			else
			{
				throw new Exception($polaczenie->error);
			}		
			$polaczenie->close();
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
	<title>Alledrogo</title>
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
	<div id="container">
		<form method="post">
		<div class="login-popup-heading text-center">
            <h4><i class="fa fa-lock" aria-hidden="true"></i> Dane do wysyłki </h4>                        
        </div>
		<div class="form-group">        
			Miasto: <br/> <input type="text" class="form-control" name="miasto" />
		</div>
		<?php
			if (isset($_SESSION['e_miasto']))
			{
				echo '<div class="error">'.$_SESSION['e_miasto'].'</div>';
				unset($_SESSION['e_miasto']);
			}
		?>
	<br>
	<div class="form-group">
		Ulica: <br/> <input type="text" class="form-control" name="ulica" />
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
		Numer domu: <br/> <input type="text" class="form-control" name="nr" />
	</div>
	<?php
		if (isset($_SESSION['e_nr']))
		{
			echo '<div class="error">'.$_SESSION['e_nr'].'</div>';
			unset($_SESSION['e_email']);
		}
	?>
	<br>
	<div class="form-group">	
		Numer mieszkania: <br/> <input type="text" class="form-control" name="nrm" />
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
		Kod pocztowy: <br/> <input type="text" class="form-control" name="zipcode" />
	</div>
	<?php
		if (isset($_SESSION['e_zipcode']))
		{
			echo '<div class="error">'.$_SESSION['e_zipcode'].'</div>';
			unset($_SESSION['e_zipcode']);
		}
	?>
	<br>
	
	<button type="submit" class="btn btn-default login-popup-btn" name="submit" value="1">Zapisz</button>
	
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