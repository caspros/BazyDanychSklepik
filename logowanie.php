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
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link rel="stylesheet" href="css/logowanie.css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">

	<title>Zaloguj się</title>
</head>


<body>	
	<!-- logo alledrogo -->
	<div id="sticky_menu">
		<ol>
			<li>
				<a href="index.php">
					<img src="images/logo.png" alt="logo" class="nav_img">
				</a>
			</li>
		</ol>
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

</body>

</html>