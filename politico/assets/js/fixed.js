
  jQuery("document").ready(function($){
    
    var nav = $('header');
    
    var menu =$('#menu-bar');
    
    $(window).scroll(function () {
        if ($(this).scrollTop() > 136) {
            nav.addClass("header-fixed");
            
            

        } else {
            nav.removeClass("header-fixed");
            
            
        }
    });
 
});
