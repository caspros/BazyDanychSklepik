<?php

session_start();

if (isset($_POST['email']))
{
	//udała sie walidacja
	$wszystko_OK=true;
	
	//poprawnosc nicka
	$nick = $_POST['nick'];
	
	//dlugosc nicku
	if((strlen($nick)<5) || (strlen($nick)>20))
	{
		$wszystko_OK=false;
		$_SESSION['e_nick']="Nick musi miec dlugosc od 5 do 20 znaków";
	}
	
	if (ctype_alnum($nick)==false)
	{
		$wszystko_OK=false;
		$_SESSION['e_nick']="Nick musi składać sie tylko z liter i cyfr";
	}
	
	//poprawnosc nicka
	$email = $_POST['email'];
	$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
	
	if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
	{
		$wszystko_OK=false;
		$_SESSION['e_email']="Podaj właściwy email";
	}
	
	//poprawnosc hasla
	$haslo1 = $_POST['haslo1'];
	$haslo2 = $_POST['haslo2'];
	
	//dlugosc hasla
	if((strlen($haslo1)<5) || (strlen($haslo1)>20))
	{
		$wszystko_OK=false;
		$_SESSION['e_haslo']="Haslo musi miec dlugosc od 5 do 20 znaków";
	}
	
	if($haslo1!=$haslo2)
	{
		$wszystko_OK=false;
		$_SESSION['e_haslo']="Podane hasła różnią się";
	}
	
	$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
	
	// akceptacja regulaminu
	if(!isset($_POST['regulamin']))
	{
		$wszystko_OK=false;
		$_SESSION['e_regulamin']="Nie zapoznaleś sie z regulaminem. Przeczytaj go!";
	}
	

	
	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	
	try
	{
		$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
		if($polaczenie->connect_errno!=0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		else
		{
			//czy email juz istnieje
			$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$email'");
			
			if(!$rezultat) throw new Exception($polaczenie->error);
			
			$ile_takich_maili = $rezultat->num_rows;
			if($ile_takich_maili>0)
			{
				$wszystko_OK=false;
				$_SESSION['e_email']="Ten adres email jest już używany";
			}
			
			//czy nick juz istnieje
			$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE user='$nick'");
			
			if(!$rezultat) throw new Exception($polaczenie->error);
			
			$ile_takich_nikow = $rezultat->num_rows;
			if($ile_takich_nikow>0)
			{
				$wszystko_OK=false;
				$_SESSION['e_nick']="Ten nick jest już używany";
			}
		if($wszystko_OK==true)
		{
			//wszystko dobrze user dodany
			if($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$nick', '$haslo_hash', '$email', 100, 100, 100, 14)"))
			{
				$_SESSION['udanarejestracja']=true;
				header('Location: witam.php');
			}
			else
			{
				throw new Exception($polaczenie->error);
			}
		}
			
			$polaczenie->close();
		}
	}
	catch(Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! Zarejestruj sie później!</span>';
		echo'<br /> Informacja deweloperska: ' .$e;
	}
	
	
	
}

?>
<!DOCTYPE html>
<head lang="pl">
	<meta charset="utf-8">
	<title> Zakładanie konta </title>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<style>
		.error
		{
			color:red;
			margin-top: 10px;
			margin-bottom: 10px;
		}
	</style>
</head>
<body>
<div id=container">
	<form method="post">
	
	Nick: <br /> <input type="text" name="nick" /><br />
	
	<?php
		if (isset($_SESSION['e_nick']))
		{
			echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
			unset($_SESSION['e_nick']);
		}
	?>
	
	E-mail: <br /> <input type="text" name="email" /><br />
	
	<?php
		if (isset($_SESSION['e_email']))
		{
			echo '<div class="error">'.$_SESSION['e_email'].'</div>';
			unset($_SESSION['e_email']);
		}
	?>
	
	Hasło: <br /> <input type="password" name="haslo1" /><br />
	
	<?php
		if (isset($_SESSION['e_haslo']))
		{
			echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
			unset($_SESSION['e_haslo']);
		}
	?>
	
	Powtórz hasło: <br /> <input type="password" name="haslo2" /><br />
	
	<label>
	<input type="checkbox" name="regulamin" /> Akceptuje regulamin
	</label>
	
	<?php
		if (isset($_SESSION['e_regulamin']))
		{
			echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
			unset($_SESSION['e_regulamin']);
		}
	?>
	
	<div class="g-recaptcha" data-sitekey="6LcT1F4UAAAAAGhKBCSu8JukWJgqkha5AXA-HL6k"></div>
	
	<?php
		if (isset($_SESSION['e_bot']))
		{
			echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
			unset($_SESSION['e_bot']);
		}
	?>
	
	<br />
	
	<input type="submit" value="Zarejestruj się"/>
	
	</form>
	</div>
	<div id="footer"> Copyright &copy; 2018 </div>
</body>
</html>