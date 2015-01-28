(function($){
$(function(){

	 $(document).ready(function(){

		//back to top button
		var $toTop = $('#back-to-top');
		if ($(window).scrollTop() <= $(window).height()) $toTop.hide();

		$toTop.on('click', function(){
			$('html,body').animate({
				scrollTop: 0
			}, 400);
		});

		$(document).on('scroll', function(event){
			if ($(window).scrollTop() > $(window).height()) $toTop.fadeIn();
			else $toTop.fadeOut();
		});
		
		$('.entry-video, .widget-video, .entry-content').fitVids();
		
		$("#toggle-menu-icon").click(function() {
		  $(".top-level-menu").slideToggle(400);
		  return false;
		});
		
		var menuTimeout;
		
		$( window ).resize( function() {
			if (menuTimeout) clearTimeout(menuTimeout);
			menuTimeout = setTimeout(recalculateMenuSize, 100);
		} );
		
		var recalculateMenuSize = function(){
			var browserWidth = $( window ).width();
			
			if ( browserWidth == $( window ).width() ) {
		        return;
		    }
			
			if ( browserWidth > 800 ) {
				$(".top-level-menu").show();
			}else{
				$(".top-level-menu").hide();
			}
		}
		
	

	});
});
})(jQuery);