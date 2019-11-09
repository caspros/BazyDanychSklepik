<?php
	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		$_SESSION['wyloguj'] = "Wyloguj";
		unset($_SESSION['zaloguj']);
	} else{
		$_SESSION['zaloguj'] = "Zaloguj";
		unset($_SESSION['wyloguj']);
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
	 <link href="fontawesome/css/all.css" rel="stylesheet">
	<title>Alledrogo</title>
</head>

<body>
	<!-- GŁÓWNY CONTAINER -->
	<div id="container"> 
	
		<!-- STICKY MENU -->
		<div id="nav">

			<ol>
				<li><a href="#"><img src="images/logo.png" alt="logo" class="nav_img"></a></li>
				<form form action="#" method="get" class="form_inline">

				<li><a href="#"><input type="text" name="search_input" class="search_input" placeholder="Wyszukaj produkt..."></a></li>
				<li><a href="#"><input style="display: inline;" type="submit" name="search_button" class="search_button" value="SZUKAJ"></a></li></form>
				<li><a href="#"><span class="koszyk"><i class="fas fa-shopping-cart"></i></span></a></li>

				<!--- DROPDOWN MENU PROFILE -->
				<div class="dropdown">
					<span id="myBtn" class="dropbtn">Witaj, 
						<?php 
						if (isset($_SESSION['wyloguj'])) 
							{
								echo $_SESSION['imie'];
							}else{
								echo "zaloguj się";
							}
						?> 
						<div id="p1"><i class="fas fa-angle-down"></i></div></span>
	  				<div id="myDropdown" class="dropdown-content">
		    			<a href="#">Moje zamówienia</a>
						<a href="#">Oceń produkt</a>
						<a href="#">Ustawienia</a>
						<?php
							if (isset($_SESSION['zaloguj']))
							{
								echo '<a href="logowanie.php">'.$_SESSION['zaloguj'].'</a>';
							} else{
								echo '<a href="wyloguj.php">'.$_SESSION['wyloguj'].'</a>';
							}
						?>
	  				</div>
				</div>

			</ol>

		</div>

		<!-- NAGŁÓWEK -->
		<div id="menu">
			<ul>	
					<div class="dropdown_kat">
				  <li><div id="myBtn_kat" class="dropbtn_kat">Kategorie</div></li>
				  		<div id="myDropdown_kat" class="dropdown-content_kat">
			    			<a href="#">Koszulki</a>
							<a href="#">Spodnie</a>
							<a href="#">Kubki</a>
							<a href="#">Długopisy</a>
	  					</div>
	  				</div>
	  				
				  <li><a href="#">Promocje</a></li>
				  <li><a href="#">Oferty dnia</a></li>
				  <li><a href="#">FAQ</a></li>
			</ul> 	
		</div>

		<!-- MIĘSO ARMATNIE -->
		<div id="main">

		<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "sklep";

		// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				$conn -> query("SET NAMES 'utf8'");
		// Check connection
		if ($conn->connect_error) {
		    die("Nie połączono z bazą danych: " . $conn->connect_error);
		}
		echo "Połączono z bazą danych";

				$sql = "SELECT nazwa, opis, opinie_klientow, cena, dostepna_ilosc, producent, rozmiar FROM produkty";
				$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        echo "<br>Nazwa produktu: " . $row["nazwa"]. "<br>Opis produktu: " . $row["opis"]."<br>Opinia klientow: ". $row["opinie_klientow"]."<br>Cena [PLN]: ". $row["cena"]."<br>Dostępna ilość: ". $row["dostepna_ilosc"]."<br>Producent: ". $row["producent"]."<br>Rozmiar: ". $row["rozmiar"];
		    }
		} else {
		    echo "0 results";
		}
		$conn->close();
		?>

		<br><br>

		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur risus neque, porttitor eu malesuada a, pulvinar quis quam. Cras sed mi sed tellus finibus posuere. Etiam purus urna, pharetra nec malesuada eu, vehicula ut sem. Donec bibendum ultrices erat quis malesuada. Sed sit amet lectus ut odio tempus dignissim id sit amet quam. Nulla elit erat, imperdiet nec tempus eu, consectetur in quam. Pellentesque in posuere arcu, et imperdiet lorem. Vestibulum faucibus mollis lacus, et maximus arcu fermentum nec. In hac habitasse platea dictumst. Maecenas ut mi tellus. Fusce euismod mollis risus, blandit blandit ex.</p>

		<p>Aenean vitae risus velit. Curabitur placerat, nibh a vulputate fermentum, eros leo finibus mauris, ullamcorper tempor enim dui ultricies sapien. Nunc commodo dapibus mi quis ultricies. Phasellus ornare dolor eget tortor placerat, commodo dictum velit sollicitudin. Sed non hendrerit odio, sed ornare ligula. Donec mattis quis erat nec imperdiet. Pellentesque vehicula sagittis scelerisque.</p>

		<p>Aenean vitae risus velit. Curabitur placerat, nibh a vulputate fermentum, eros leo finibus mauris, ullamcorper tempor enim dui ultricies sapien. Nunc commodo dapibus mi quis ultricies. Phasellus ornare dolor eget tortor placerat, commodo dictum velit sollicitudin. Sed non hendrerit odio, sed ornare ligula. Donec mattis quis erat nec imperdiet. Pellentesque vehicula sagittis scelerisque.</p>

		<p>Aenean vitae risus velit. Curabitur placerat, nibh a vulputate fermentum, eros leo finibus mauris, ullamcorper tempor enim dui ultricies sapien. Nunc commodo dapibus mi quis ultricies. Phasellus ornare dolor eget tortor placerat, commodo dictum velit sollicitudin. Sed non hendrerit odio, sed ornare ligula. Donec mattis quis erat nec imperdiet. Pellentesque vehicula sagittis scelerisque.</p>

		<p>Aenean vitae risus velit. Curabitur placerat, nibh a vulputate fermentum, eros leo finibus mauris, ullamcorper tempor enim dui ultricies sapien. Nunc commodo dapibus mi quis ultricies. Phasellus ornare dolor eget tortor placerat, commodo dictum velit sollicitudin. Sed non hendrerit odio, sed ornare ligula. Donec mattis quis erat nec imperdiet. Pellentesque vehicula sagittis scelerisque.</p>

		<p>Aenean vitae risus velit. Curabitur placerat, nibh a vulputate fermentum, eros leo finibus mauris, ullamcorper tempor enim dui ultricies sapien. Nunc commodo dapibus mi quis ultricies. Phasellus ornare dolor eget tortor placerat, commodo dictum velit sollicitudin. Sed non hendrerit odio, sed ornare ligula. Donec mattis quis erat nec imperdiet. Pellentesque vehicula sagittis scelerisque.</p>

		<p>Aenean vitae risus velit. Curabitur placerat, nibh a vulputate fermentum, eros leo finibus mauris, ullamcorper tempor enim dui ultricies sapien. Nunc commodo dapibus mi quis ultricies. Phasellus ornare dolor eget tortor placerat, commodo dictum velit sollicitudin. Sed non hendrerit odio, sed ornare ligula. Donec mattis quis erat nec imperdiet. Pellentesque vehicula sagittis scelerisque.</p>

		</div>

		<!-- STOPKA -->
		<div id="footer">
		
			Korzystanie z serwisu oznacza akceptację <a href="#">regulaminu</a>
		</div>
			
	</div>

	

	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

	<!-- STICKY MENU JS-->
	<script>
 
	    $(document).ready(function() {
	    var NavY = $('#nav').offset().top;
	      
	    var stickyNav = function(){
	    var ScrollY = $(window).scrollTop();
	           
	    if (ScrollY > NavY) { 
	        $('#nav').addClass('sticky');
	    } else {
	        $('#nav').removeClass('sticky'); 
	    }
	    };
	      
	    stickyNav();
	      
	    $(window).scroll(function() {
	        stickyNav();
	    });
	    });
     
	</script>

	<!-- DROPDOWN MENU PROFILE JS-->
	<script>
		document.getElementById("myBtn").onclick = function() {funkcja()};

		function funkcja() {
  		document.getElementById("myDropdown").classList.toggle("show");
		}

		$( document ).ready(function() {
		 $('.dropbtn').click(function(){ 
		 	$(this).parent().find('.dropdown').toggleClass('active'); 
		 	if($(this).find('i.fas').hasClass('fa-angle-down')) { 
		 		$(this).find('i.fas').removeClass('fa-angle-down').addClass('fa-angle-up');
		 		} else if($(this).find('i.fas').hasClass('fa-angle-up')) { 
		 			$(this).find('i.fas').removeClass('fa-angle-up').addClass('fa-angle-down'); 
		 		} 
		 	}) 
			})();
	</script>

	<script>
		document.getElementById("myBtn_kat").onclick = function() {funkcja1()};

		function funkcja1() {
  		document.getElementById("myDropdown_kat").classList.toggle("show1");
		}
	</script>

</body>

</html>
