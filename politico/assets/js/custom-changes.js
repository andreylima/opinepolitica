window.onload=function(){

jQuery(".open_menu").click(function(){

	if (jQuery("#menu-body").hasClass("show-menu")) {
		jQuery("#menu-body").removeClass("show-menu");
		jQuery("#destaque").removeClass("destaque-fit");
		jQuery("#archive-wrapper").removeClass("archive-wrapper-fit");
		jQuery("#page-wrapper").removeClass("page-wrapper-fit");
		jQuery("#single-wrapper").removeClass("single-wrapper-fit");

	}
	else
	{
		jQuery("#menu-body").addClass("show-menu");
		jQuery("#destaque").addClass("destaque-fit");
		jQuery("#archive-wrapper").addClass("archive-wrapper-fit");
		jQuery("#page-wrapper").addClass("page-wrapper-fit");
		jQuery("#single-wrapper").addClass("single-wrapper-fit");
	};

});

jQuery(".log-out").click(function(){

	 FB.getLoginStatus(function(response) {
        if (response && response.status === 'connected') {
            FB.logout(function(response) {
                document.location.reload();
            });
        }
    });


});	

		
jQuery('.projetos-slider').flicker();
jQuery('.vereadores-slider').flicker();



if (jQuery(window).width() <= 480) {

	jQuery(".user-logged").click(function(){

		if (jQuery(".user-menu").hasClass("display-block")) {
			jQuery(".user-menu").removeClass("display-block");
		}
		else
		{
			jQuery(".user-menu").addClass("display-block");
		}
		



	});

};



jQuery("#menu-body ul li a").append("<i class='fa fa-arrow-right arrow-margin'></i>");





jQuery(".check_aceito").click( function(){

var id = '#modal-termos';
	
				var maskHeight = jQuery(document).height();
				var maskWidth = jQuery(window).width();

				jQuery('#mask').css({'width':maskWidth,'height':maskHeight});

				jQuery('#mask').fadeIn();	
				jQuery('#mask').fadeTo('fast',0.5);	

					//Get the window height and width
				var winH = jQuery(window).height();
				var winW = jQuery(window).width();
		              
				jQuery(id).css('top',  "15%");
				jQuery(id).css('left', "5%");
			
				jQuery(id).fadeIn(); 

});


jQuery('#modal-termos .close').click(function (e) {
		e.preventDefault();
		
		jQuery('#mask').hide();
		jQuery('#modal-termos').hide();
	});	

jQuery('#mask').click(function () {
		jQuery(this).hide();
		jQuery('#modal-termos').hide();
	});	

}
