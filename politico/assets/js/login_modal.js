
  jQuery(function ($) {

$('.window .close').click(function (e) {
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});		
	
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});		

		$('#register-manual').click(function() {

			width = $(window).width(); 
			
			if (width <= 480) {
				window.location = "#login-wrapper-footer";
				$('#mask').hide();
				$('.window').hide();
				return false;
			}
			window.location = "#destaque";
				$('#mask').hide();
				$('.window').hide();
			
		});		

});