<?php
	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{	
		header('Location: index.php');
		exit();
	}

	if (isset($_SESSION['wyloguj']))
	{
		unset($_SESSION['wyloguj']);
		session_unset();
		header('Location: index.php');
	}

?>

<!DOCTYPE HTML>
<html lang="pl">

<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/hamburger.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link rel="stylesheet" href="css/logowanie.css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">

	<title>Zaloguj się</title>
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
		
	  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
	    <i class="fa fa-bars"></i>
	  </a>
	</div> 
	<!-- GŁÓWNY CONTAINER -->
	
	<div class="login-popup-wrap new_login_popup"> 
		<div id="container">
			<div class="login-popup-heading text-center">
                 <h4><i class="fa fa-lock" aria-hidden="true"></i> Logowanie </h4>                        
            </div>

			<form action="zaloguj.php" method="post" action="">
				<div class="form-group">
					<input type="text" class="form-control" id="user_id" placeholder="e-mail" name="email">
				</div>

				<div class="form-group">
					<input type="password" class="form-control" id="password" placeholder="haslo" name="haslo">
			 	</div>

				<button type="submit" class="btn btn-default login-popup-btn" name="submit" value="1">Zaloguj</button>
			</form>

			<?php
				if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
			?>

			<div class="form-group text-center">
				<a href="rejestracja.php">
					<br>Nie posiadasz konta? Zarejestruj się!<br>
				</a>
			</div>

		</div>
	</div>

	<!-- STÓPKA -->
	<div id="footer">
		Copyright &copy; 2019 
	</div>

	<!-- JAVASCRIPT DO LOGOWANIA -->
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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