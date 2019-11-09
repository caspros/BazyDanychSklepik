<?php

	session_start();
	
	if ((!isset($_POST['email'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}

	require_once "connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	

		$email = $_POST['email'];
		$haslo = $_POST['haslo'];

		$sql = "SELECT * FROM klienci WHERE email = '$email'";

		if ($rezultat = @$polaczenie->query($sql))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				$wiersz = $rezultat->fetch_assoc();
				
				if ((md5($haslo)) == ($wiersz['haslo']))
				{
					$_SESSION['zalogowany'] = true;
					$_SESSION['imie'] = $wiersz['Imie'];
					$rezultat->free_result();
					unset($_SESSION['blad']);
					header('Location: index.php');
				}
				else 
				{
					$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy email lub hasło!</span>';
					header('Location: logowanie.php');
				}
				
			} else {
				
				$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy email lub hasło!</span>';
				header('Location: logowanie.php');
			}
			
		}
		
		$polaczenie->close();
	
?>