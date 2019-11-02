<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="Stylesheet" href="style.css">
	<title>Alledrogo</title>
</head>

<body>
	<header>
		<h2>To jest nasza strona główna</h2>
		<br/>
		<img src="logo.png" alt="logo">
		<br/>
		<ul id = "menu">
			<li><a href="#">Promocje</a></li>
			<li><a href="#">Oferty dnia</a></li>
			<li><a href="#">Koszyk</a></li>
			<li><a href="#">Konto</a>
				<ul>
					<li><a href="#">Ustawienia</a></li>
					<li><a href="#">Znajomi</a></li>
					<li><a href="#">Wyloguj</a></li>
				</ul>
			
			</li>
		</ul>
	</header>
	<section>
<?php
	echo "<br/>Witamy<br/>";
	echo "To jest nasza główna strona po zmianie";
	echo "<br/>Tutaj dodalem cos w xamppie";
	echo "<br/>Trobimy cos w main-site";
?>
	</section>
	<footer>
		<p>Kliknij aby zobaczyć <a href="index.php">Stronę główną</a></p>
	</footer>

</body>
</html>
