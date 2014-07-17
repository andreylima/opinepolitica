window.onload=function(){

jQuery(".open_menu").click(function(){

	if (jQuery("#menu-body").hasClass("show-menu")) {
		jQuery("#menu-body").removeClass("show-menu");
		jQuery("#destaque").removeClass("destaque-fit");
		jQuery("#archive-wrapper").removeClass("archive-wrapper-fit");

	}
	else
	{
		jQuery("#menu-body").addClass("show-menu");
		jQuery("#destaque").addClass("destaque-fit");
		jQuery("#archive-wrapper").addClass("archive-wrapper-fit")
	};

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




}
