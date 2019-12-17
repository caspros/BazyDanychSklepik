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
?>

<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<title>Dodano komentarz!</title>
</head>
<body>

<?php
	//Dane do bazy danych
	$id_klienci = $_SESSION['id_klienci'];
	$ocena = $_POST['ocena'];
	$opis = '"'.$_POST['opis'].'"';
	//$id_produktu = $_GET['id_produkty'];
	$id_produktu = $_POST['id_produktu'];
	

	//Połączenie
	require_once "connect.php";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn -> query("SET NAMES 'utf8'");
	// Sprawdzenie połączenia
	if ($conn -> connect_error) {
		    die("Nie połączono z bazą danych: " . $conn -> connect_error);
		}

	$sql = "INSERT INTO opinie(id_produkty, id_klienci, gwiazdka, opinia) VALUES ($id_produktu, $id_klienci, $ocena, $opis)";
	$sql2 = "SET FOREIGN_KEY_CHECKS = 0";
	$conn -> query($sql2);
	if($conn -> query($sql) === TRUE)
	{
		echo "<h2>Ocena dodana, dziękujemy!</h2>";
	}
	else { echo "Error: " . $sql . "<br>" . $conn->error;}
?>

<br>
<a href="index.php">Powrót na stronę główną</a>
</body>
</html>