(function($){
	$(function(){
		$('a.introsocial-toggle-link').unbind('click').click(function(event){//unbind because this script is included once / instance and we really only want one handler
			$(this).parent().next().slideToggle();
			event.preventDefault();
			event.stopPropagation();
		});
	});
})(jQuery);