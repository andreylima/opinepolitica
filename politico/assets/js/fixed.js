
  jQuery("document").ready(function($){
    
    var nav = $('header');
    var logo = $('#logo');
    var menu =$('#menu-bar');
    
    $(window).scroll(function () {
        if ($(this).scrollTop() > 136) {
            nav.addClass("header-fixed");
            logo.addClass("logo-index-small");
            menu.addClass("menu-position");

        } else {
            nav.removeClass("header-fixed");
            logo.removeClass("logo-index-small");
            menu.removeClass("menu-position");
        }
    });
 
});
