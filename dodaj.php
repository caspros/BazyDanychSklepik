<?php  
$nazwa=$_POST['nazwa'];
$opis = $_POST['opis'];
$cena=$_POST['cena']; 
$dostepna_ilosc=$_POST['dostepna_ilosc']; 
$producent=$_POST['producent']; 
$rozmiar=$_POST['rozmiar']; 
$zdjecie=$_POST['zdjecie']; 

include("connect.php");
session_start();
    if (isset($_SESSION['zalogowany'])==true) {
		$polaczenie = mysqli_connect($servername, $username, $password);
		mysqli_select_db($polaczenie, $dbname);
		mysqli_query($polaczenie, "SET CHARSET utf8");
		mysqli_query($polaczenie, "INSERT INTO produkty SET idprodukty ='', nazwa='$nazwa',opis='$opis', opinie_klientow='', cena='$cena', dostepna_ilosc='$dostepna_ilosc', producent='$producent', oceny='', rozmiar='$rozmiar', zdjecie='$zdjecie', idkategorie='', idklienci=''");
		//$a = mysqli_query($polaczenie, "SELECT uprawnienia FROM klienci WHERE email='$email'");
		mysqli_close($polaczenie);
		//if($a!=1){
			//echo '<a href="index.php">Nie możesz dodać produktu. Brak uprawnień</a>'.'<br/><br/>';
		//} else {
			//header('location: dodaj.html');
		//}
     } else { 
 		header('location: logowanie.php');
	}


?>