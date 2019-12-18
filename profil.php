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
	$id_klienci = $_SESSION['id_klienci'];

	

	//Testowe do wyswietlania z bazy danych w polach
	require_once "connect.php";
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
			$u = "";
			$k = "";
			$m = "";
			$d = "";
			$l = "";
		}
	}

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
	<link rel="stylesheet" type="text/css" href="css/hamburger.css">
	<link rel="stylesheet" type="text/css" href="css/profil.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
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

		.udana
		{
			color:green;
			margin-top: 10px;
			margin-bottom: 10px;
		}
	</style>
	<title>Dane profilu</title>
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
			
			<div class="login-popup-wrap new_login_popup"> 
				<div id="container_dane">
					<?php
						if (isset($_SESSION['udanedanezamieszkania']))
						{
							//echo "<meta http-equiv='refresh' content='0'>";
							echo '<div class="udana">'.$_SESSION['udanedanezamieszkania'].'</div>';
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
								$u = "";
								$k = "";
								$m = "";
								$d = "";
								$l = "";
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
						<input type="hidden" name="ustawiono" id="ustawiono"/>
						<button type="submit" class="btn btn-default login-popup-btn " id="ustaw_dane_btn" name="submit">Zapisz</button>
					</form>
				</div>
			</div>		
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