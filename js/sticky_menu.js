$(document).ready(function() {
	var NavY = $('#sticky_menu').offset().top;
			      
	var stickyNav = function(){
		var ScrollY = $(window).scrollTop();
					           
		if (ScrollY > NavY) { 
			$('#sticky_menu').addClass('sticky');
		} else {
			$('#sticky_menu').removeClass('sticky'); 
		}
	};
			      
	stickyNav();	

	$(window).scroll(function() {
	    stickyNav();
	});
});  