window.onload=function(){

jQuery(".open_menu").click(function(){

	if (jQuery("#menu-body").hasClass("show-menu")) {
		jQuery("#menu-body").removeClass("show-menu");
	}
	else
	{
		jQuery("#menu-body").addClass("show-menu");
	};

})

	

		
jQuery('.flicker-example').flicker();

jQuery(".mini-percent-naoapoiaram").each(function(){ 

	var percent_naoapoio = jQuery(this).text().replace(/^\s+|\s+$/g,"");
	percent_naoapoio =  percent_naoapoio.replace(/[^\w\s]/gi, '');
	percent_naoapoio -= 0.5;

	jQuery(this).css("width", percent_naoapoio + "%");


});
jQuery('.flicker-example').flicker();

jQuery(".mini-percent-apoiaram").each(function(){ 

	var percent_naoapoio = jQuery(this).text().replace(/^\s+|\s+$/g,"");
	percent_naoapoio =  percent_naoapoio.replace(/[^\w\s]/gi, '');
	percent_naoapoio -= 2;

	jQuery(this).css("width", percent_naoapoio + "%");


});




}
