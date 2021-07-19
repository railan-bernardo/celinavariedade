$(document).ready(function(){
	var menuOpen = false;

	var windowSize = $(window)[0].innerWidth;
	
	$(window).resize(function(){
		if(windowSize >= 900){
			menuOpen = true;
			$('header ul').css('display', 'block');
		}
	});

	$("#menuBtn").click(function(){
		if(menuOpen){
			$('header ul').css('display', 'none');
			menuOpen = false;
		}else{
			$('header ul').css('display', 'block');
			menuOpen = true;
		}
		

	});
});