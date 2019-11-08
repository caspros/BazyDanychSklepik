<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: test.php');
		exit();
	}

?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
	<title>Alledrogo</title>
</head>

<body>


<form action="zaloguj.php" method="post">
	Email:<br>
	<input type="text" name="email"><br>
	Hasło:<br>
	<input type="password" name="haslo"><br>
 
	<button type="submit">Zaloguj</button>
</form>

<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
?>

<div class="main_logowanie">
	<a href="rejestracja.php"><br>Nie posiadasz konta? Zarejestruj się!<br></a>
</div>

</body>

</html>