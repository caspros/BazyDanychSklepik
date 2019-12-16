<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<title>Dodano produkt!</title>
</head>
<body>

<?php
	//Dodawanie pliku
	$filename = $_FILES["myfile"]["name"];
	$filetype = $_FILES["myfile"]["type"];
	$filesize = $_FILES["myfile"]["size"];
	$tempfile = $_FILES["myfile"]["tmp_name"];
	$filenameWithDirectory = "images/products/".$filename;

	//Dane do bazy danych
	$nazwa='"'.$_POST['nazwa'].'"';
	$opis = '"'.$_POST['opis'].'"';
	$cena='"'.$_POST['cena'].'"';
	$dostawa='"'.$_POST['dostawa'].'"';
	$dostepna_ilosc='"'.$_POST['dostepna_ilosc'].'"'; 
	$producent='"'.$_POST['producent'].'"'; 
	$rozmiar='"'.$_POST['rozmiar'].'"'; 
	$kategoria=$_POST['kategoria'];
	$filename1 = '"'.$filename.'"';

	//Połączenie
	require_once "connect.php";
	$conn = new mysqli($servername, $username, $password, $dbname);
		$conn -> query("SET NAMES 'utf8'");
		// Sprawdzenie połączenia
		if ($conn -> connect_error) {
			    die("Nie połączono z bazą danych: " . $conn -> connect_error);
			}

		$sql = "INSERT INTO produkty(nazwa, opis, cena, dostepna_ilosc, producent, rozmiar, zdjecie, id_kategorie, dostawa) VALUES ($nazwa, $opis, $cena, $dostepna_ilosc, $producent, $rozmiar, $filename1, $kategoria, $dostawa)";
		$sql2 = "SET FOREIGN_KEY_CHECKS = 0";
		$conn -> query($sql2);
		if($conn -> query($sql) === TRUE)
		{
			//header('Location: addProduct.php');
			//exit();
			echo "<h2>Produkt dodany</h2>";
		}
		else { echo "Error: " . $sql . "<br>" . $conn->error;}
?>


<?php
	if(move_uploaded_file($tempfile, $filenameWithDirectory))
	{
		echo "<h2>Zdjęcie produktu dodane prawidłowo</h2>";
	}
	else 
	{
		echo "Error podczas dodawania pliku!";
	}
?>
<br>
<a href="index.php">Powrót na stronę główną</a>
</body>
</html>