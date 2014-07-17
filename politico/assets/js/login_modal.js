
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
   window.location = "#destaque";
   $('#mask').hide();
   $('.window').hide();
});		

});