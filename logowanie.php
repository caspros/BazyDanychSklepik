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
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
	<title>Alledrogo</title>
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
	<div id="container">
		<div class="main">

			<form action="zaloguj.php" method="post">
			Email:<br>
			<input type="text" name="email"><br><br>
			Hasło:<br>
			<input type="password" name="haslo"><br><br>
		 
			<button type="submit">Zaloguj</button>
			</form>

			<?php
				if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
			?>

			<div class="main_logowanie">
				<a href="rejestracja.php">
					<br>Nie posiadasz konta? Zarejestruj się!<br>
				</a>
			</div>

		</div>
	</div>

	<!-- STÓPKA -->
	<div id="footer">
		Copyright &copy; 2018 
	</div>

</body>

</html>