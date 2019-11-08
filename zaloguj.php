<?php

	session_start();
	
	if ((!isset($_POST['email'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}

	require_once "connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$email = $_POST['email'];
		$haslo = $_POST['haslo'];

		$sql = "SELECT * FROM klienci WHERE email = '$email'";

		if ($rezultat = @$polaczenie->query($sql))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				$wiersz = $rezultat->fetch_assoc();
				
				if (md5($haslo) == $wiersz['haslo'])
				{
					$_SESSION['zalogowany'] = true;
					$_SESSION['imie'] = $wiersz['Imie'];
					unset($_SESSION['blad']);
					$rezultat->free_result();
					header('Location: index.php');
				}
				else 
				{
					$_SESSION['blad'] = '<span style="color:red">1Nieprawidłowy login lub hasło!1</span>';
					header('Location: index.php');
				}
				
			} else {
				
				$_SESSION['blad'] = '<span style="color:red">2Nieprawidłowy login lub hasło!</span>';
				header('Location: index.php');
				
			}
			
		}
		
		$polaczenie->close();
	}
	
?>