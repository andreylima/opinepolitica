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

jQuery(".mini-percent-naoapoiaram").each(function(){ jQuery(this).css("width", jQuery(this).text())});
jQuery(".mini-percent-apoiaram").each(function(){ jQuery(this).css("width", jQuery(this).text())});

jQuery(".apoio").each(function(){
if (jQuery(this.find(".mini-percent-apoiaram") ).text() == "0%" ) {

jQuery(".mini-percent-naoapoiaram").each(function(){ jQuery(this).css("width", "50%")});
jQuery(".mini-percent-apoiaram").each(function(){ jQuery(this).css("width", "50%")});

};

});


}
