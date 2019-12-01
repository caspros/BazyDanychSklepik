<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<title>Dodaj produkt</title>
</head>
<body>
	<form action="addingProduct.php" method="post" enctype="multipart/form-data">
	
			Nazwa:<input type="text" name="nazwa">
	
			Opis:<textarea name="opis" cols="20" rows="5"></textarea>
		
			Cena:<input type="text" name="cena">
		
			Dostępna ilość:<input type="text" name="dostepna_ilosc">
	
			Producent:<input type="text" name="producent">

			Rozmiar:<input type="text" name="rozmiar">

			Kategoria:
			<select name="kategoria">
				  <option value="1">Koszulki</option>
				  <option value="2">Spodnie</option>
				  <option value="3">Kubki</option>
				  <option value="4">Długopisy</option>
				  <option value="5">Bluzy</option>
				  <option value="6">Naklejki</option>
				  <option value="7">Ramki</option>
				  <option value="8">RTV</option>
				  <option value="9">AGD</option>
				  <option value="10">Alkohol</option>
				  <option value="11">Zabawki</option>
			</select>

		
	   			Select image to upload:
	   			<input type="file" name="myfile">
	    		

	
		<input name="submit" type=submit value="Dodaj">
		
	</form>
</body>
</html>