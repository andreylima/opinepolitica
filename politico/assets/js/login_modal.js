
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
				window.location = "#cadastro-wrapper-footer";
				$('#mask').hide();
				$('.window').hide();
				return false;
			}
			window.location = "#destaque";
				$('#mask').hide();
				$('.window').hide();
			
		});	



		$('#register-manual-inside').click(function() {

					
				window.location = "http://www.debategv.com.br";
				$('#mask').hide();
				$('.window').hide();
				
			
			
		});		

$('.aba-aviso').click(function (e) {

if (!$("#mask").is(":visible")) 
{
  var maskHeight = jQuery(document).height();
        var maskWidth = jQuery(window).width();

        jQuery('#mask').css({'width':maskWidth,'height':maskHeight});

        jQuery('#mask').fadeIn(); 
        jQuery('#mask').fadeTo('fast',0.5); 

}
else
{
  $("#mask").hide();
}


if (jQuery("#mask").hasClass("dark-mask")) {
  jQuery("#mask").removeClass("dark-mask");

}



if (jQuery(".aviso-projeto").hasClass("show-aviso")) {
  jQuery(".aviso-projeto").removeClass("show-aviso");

}
else
{
  jQuery(".aviso-projeto").addClass("show-aviso");


}		


});  

$('#mask').click(function () {
  $(this).hide();
  if (jQuery(".aviso-projeto").hasClass("show-aviso")) {
    jQuery(".aviso-projeto").removeClass("show-aviso");
    }
    if (jQuery("#mask").hasClass("dark-mask")) {
  jQuery("#mask").removeClass("dark-mask");

}

});

$(function() {
    if (!getCookie('modalOpened')) {
        $(".aviso-projeto").addClass("show-aviso");
        $("#mask").addClass("dark-mask");
        // Set value to true to prevent the modal from opening again 
        setCookie('modalOpened', true);
    }
});







});  



function setCookie(name, value, daysToLive) {
    var expirationDate = new Date();
    expirationDate.setDate(expirationDate.getDate() + daysToLive);
    document.cookie = name + '=' + escape(value) + ((daysToLive == null) ? '' : '; expires=' + expirationDate.toUTCString());
}

function getCookie(name) {
    var cookies=document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        if (cookies[i].substr(0, cookies[i].indexOf('=')).replace(/^\s+|\s+$/g, '') == name) {
            return unescape(cookies[i].substr(cookies[i].indexOf('=') + 1));
        }
    }
}