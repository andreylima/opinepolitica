jQuery(".open_menu").click(function(){

	if (jQuery("#menu-body").hasClass("show-menu")) {
		jQuery("#menu-body").removeClass("show-menu");
	}
	else
	{
		jQuery("#menu-body").addClass("show-menu");
	};

})