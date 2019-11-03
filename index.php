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
	<div id="container"> 
	<!-- GŁÓWNY CONTAINER -->

		<div id="nav">

			<ol>
				<li><a href="#"><img src="images/logo.png" alt="logo" class="nav_img"></a></li>
				<form form action="#" method="get" class="form_inline">

				<li><a href="#"><input type="text" name="search_input" class="search_input" placeholder="Wyszukaj produkt..."></a></li>
				<li><a href="#"><input style="display: inline;" type="submit" name="search_button" class="search_button" value="SZUKAJ"></a></li></form>
				<li><a href="#"><span class="koszyk"><i class="fas fa-shopping-cart"></i></span></a></li>
				<li><a href="#"><span class="profil">Profil BENO</span></a></li>
			</ol>

		</div>


		<div id="header">
		<!-- NAGŁÓWEK -->
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
		</div>

		<div id="main">
		<!-- MIĘSO ARMATNIE -->
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur risus neque, porttitor eu malesuada a, pulvinar quis quam. Cras sed mi sed tellus finibus posuere. Etiam purus urna, pharetra nec malesuada eu, vehicula ut sem. Donec bibendum ultrices erat quis malesuada. Sed sit amet lectus ut odio tempus dignissim id sit amet quam. Nulla elit erat, imperdiet nec tempus eu, consectetur in quam. Pellentesque in posuere arcu, et imperdiet lorem. Vestibulum faucibus mollis lacus, et maximus arcu fermentum nec. In hac habitasse platea dictumst. Maecenas ut mi tellus. Fusce euismod mollis risus, blandit blandit ex.</p>

		<p>Aenean vitae risus velit. Curabitur placerat, nibh a vulputate fermentum, eros leo finibus mauris, ullamcorper tempor enim dui ultricies sapien. Nunc commodo dapibus mi quis ultricies. Phasellus ornare dolor eget tortor placerat, commodo dictum velit sollicitudin. Sed non hendrerit odio, sed ornare ligula. Donec mattis quis erat nec imperdiet. Pellentesque vehicula sagittis scelerisque.</p>

		<p>Aenean vitae risus velit. Curabitur placerat, nibh a vulputate fermentum, eros leo finibus mauris, ullamcorper tempor enim dui ultricies sapien. Nunc commodo dapibus mi quis ultricies. Phasellus ornare dolor eget tortor placerat, commodo dictum velit sollicitudin. Sed non hendrerit odio, sed ornare ligula. Donec mattis quis erat nec imperdiet. Pellentesque vehicula sagittis scelerisque.</p>

		<p>Aenean vitae risus velit. Curabitur placerat, nibh a vulputate fermentum, eros leo finibus mauris, ullamcorper tempor enim dui ultricies sapien. Nunc commodo dapibus mi quis ultricies. Phasellus ornare dolor eget tortor placerat, commodo dictum velit sollicitudin. Sed non hendrerit odio, sed ornare ligula. Donec mattis quis erat nec imperdiet. Pellentesque vehicula sagittis scelerisque.</p>

		<p>Aenean vitae risus velit. Curabitur placerat, nibh a vulputate fermentum, eros leo finibus mauris, ullamcorper tempor enim dui ultricies sapien. Nunc commodo dapibus mi quis ultricies. Phasellus ornare dolor eget tortor placerat, commodo dictum velit sollicitudin. Sed non hendrerit odio, sed ornare ligula. Donec mattis quis erat nec imperdiet. Pellentesque vehicula sagittis scelerisque.</p>

		<p>Aenean vitae risus velit. Curabitur placerat, nibh a vulputate fermentum, eros leo finibus mauris, ullamcorper tempor enim dui ultricies sapien. Nunc commodo dapibus mi quis ultricies. Phasellus ornare dolor eget tortor placerat, commodo dictum velit sollicitudin. Sed non hendrerit odio, sed ornare ligula. Donec mattis quis erat nec imperdiet. Pellentesque vehicula sagittis scelerisque.</p>

		<p>Aenean vitae risus velit. Curabitur placerat, nibh a vulputate fermentum, eros leo finibus mauris, ullamcorper tempor enim dui ultricies sapien. Nunc commodo dapibus mi quis ultricies. Phasellus ornare dolor eget tortor placerat, commodo dictum velit sollicitudin. Sed non hendrerit odio, sed ornare ligula. Donec mattis quis erat nec imperdiet. Pellentesque vehicula sagittis scelerisque.</p>

		</div>

		<div id="footer">
		<!-- STOPKA -->
			Korzystanie z serwisu oznacza akceptację <a href="#">regulaminu</a>
		</div>
			
	</div>

	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

	<!-- STICKY MENU -->
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

</body>

</html>
