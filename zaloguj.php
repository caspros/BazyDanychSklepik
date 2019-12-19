<?php

	session_start();
	
	if ((!isset($_POST['email'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}

	require_once "connect.php";

	$polaczenie = @new mysqli($servername, $username, $password, $dbname);
	$polaczenie -> query("SET NAMES 'utf8'");
	$email = $_POST['email'];
	$haslo = $_POST['haslo'];

	$sql = "SELECT * FROM klienci WHERE email = '$email'";

	if ($rezultat = @$polaczenie -> query($sql))
	{
		$ilu_userow = $rezultat -> num_rows;
		if($ilu_userow > 0)
		{
			$wiersz = $rezultat->fetch_assoc();
			
			if ((md5($haslo)) == ($wiersz['haslo']))
			{
				$_SESSION['zalogowany'] = true;
				$_SESSION['imie'] = $wiersz['Imie'];
				$_SESSION['email'] = $wiersz['email'];
				$_SESSION['id_klienci'] = $wiersz['id_klienci'];
				$_SESSION['uprawnienia'] = $wiersz['uprawnienia'];
				$id_k = $_SESSION['id_klienci'];

				$sql = "SELECT * FROM adres WHERE id_klienci = '$id_k'";
				if ($result = @$polaczenie -> query($sql))
				{
					$num_rows = $result -> num_rows;
					if($num_rows > 0)
					{
						$row = $result->fetch_assoc();
						$_SESSION['ulica'] = $row['ulica'];
						$_SESSION['kod_pocztowy'] = $row['kod_pocztowy'];
						$_SESSION['miasto'] = $row['miasto'];
						$_SESSION['nr_domu'] = $row['nr_domu'];
						$_SESSION['nr_lokalu'] = $row['nr_lokalu'];
					}
					$result -> free_result();
				}
				$rezultat -> free_result();
				unset($_SESSION['blad']);
				header('Location: index.php');
			} else {
				$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy email lub hasło!</span>';
				header('Location: logowanie.php');
			}
			
		} else {
			$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy email lub hasło!</span>';
			header('Location: logowanie.php');
		}	
	}
		
	$polaczenie -> close();	
?>