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