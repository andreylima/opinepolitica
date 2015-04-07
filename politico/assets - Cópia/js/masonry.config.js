jQuery(function ($) {
 
	var $container = $('#container'); //The ID for the list with all the blog posts
	$container.isotope({ //Isotope options, 'item' matches the class in the PHP
		itemSelector : '.mini-projeto', 
		

		  		
	});
 

 	var $perfis = $('#perfis');
	$perfis.isotope({ //Isotope options, 'item' matches the class in the PHP
		itemSelector : '.perfil', 

				  		
	});
 
});




