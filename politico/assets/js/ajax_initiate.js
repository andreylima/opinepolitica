window.onload=function(){

	jQuery('.curtir').click(function(events){
		
		var acao = "curtir";
		var id_votado = jQuery(this).attr('id');
		declaraApoio(events,acao,id_votado);
		// jQuery(this).addClass("votado");
		// jQuery("div#" + id_votado + ".voten").removeClass("votado");
		events.preventDefault();	
		});	

	jQuery('.naocurtir').click(function(events){
		var acao = "naocurtir";
		var id_votado = jQuery(this).attr('id');
		declaraApoio(events,acao,id_votado);
		// jQuery(this).addClass("votado");
		// jQuery("div#" + id_votado + ".votes").removeClass("votado");
		events.preventDefault();	
		});

	jQuery('.positivar-projeto').click(function(events){
		var acao = "positivar_projeto";
		var id_votado = jQuery(this).attr('id');
		declaraApoio(events,acao,id_votado);
		// jQuery(this).addClass("votado");
		// jQuery("div#" + id_votado + ".voten").removeClass("votado");
		events.preventDefault();
		});

	jQuery('.negativar-projeto').click(function(events){
		var acao = "negativar_projeto";
		var id_votado = jQuery(this).attr('id');
		declaraApoio(events,acao,id_votado);
		// jQuery(this).addClass("votado");
		// jQuery("div#" + id_votado + ".votes").removeClass("votado");
		events.preventDefault();	
		});

	validate_form();


};	



function declaraApoio(events,acao,id_votado){

		
	jQuery.ajax({
		type: 'POST',
		url: myAjax.ajaxurl,
		data: 'action=verify_login&acao='+acao+'&id_votado='+id_votado,
		success: function(response) {
		
			console.log(response);
			var response = JSON.parse(response);
			
			if (response.logged != false) {

			
			switch(acao){

				case "curtir":
				jQuery("div#" + id_votado + ".votes > .percent-autor" ).text(response.curtiu);
				jQuery("div#" + id_votado + ".voten > .percent-autor" ).text(response.naocurtiu);
				jQuery("div#" + id_votado + ".votes").addClass("votado");
				jQuery("div#" + id_votado + ".voten").removeClass("votado");
				break;
				case "naocurtir":
				jQuery("div#" + id_votado + ".votes > .percent-autor" ).text(response.curtiu);
				jQuery("div#" + id_votado + ".voten > .percent-autor" ).text(response.naocurtiu);
				jQuery("div#" + id_votado + ".voten").addClass("votado");
				jQuery("div#" + id_votado + ".votes").removeClass("votado");
				break;
				case "positivar_projeto":
				jQuery("div#" + id_votado + ".votes > .percent-projeto" ).text(response.positivou);
				jQuery("div#" + id_votado + ".voten > .percent-projeto" ).text(response.negativou);
				jQuery("div#" + id_votado + ".votes").addClass("votado");
				jQuery("div#" + id_votado + ".voten").removeClass("votado");
				break;
				case "negativar_projeto":
				jQuery("div#" + id_votado + ".votes > .percent-projeto" ).text(response.positivou);
				jQuery("div#" + id_votado + ".voten > .percent-projeto" ).text(response.negativou);
				jQuery("div#" + id_votado + ".voten").addClass("votado");
				jQuery("div#" + id_votado + ".votes").removeClass("votado");
				break;
			
				
			};



			}
			else
			{


				var id = '#dialog';
	
				var maskHeight = jQuery(document).height();
				var maskWidth = jQuery(window).width();

				jQuery('#mask').css({'width':maskWidth,'height':maskHeight});

				jQuery('#mask').fadeIn();	
				jQuery('#mask').fadeTo('fast',0.5);	

					//Get the window height and width
				var winH = jQuery(window).height();
				var winW = jQuery(window).width();
		              
				jQuery(id).css('top',  winH/2-jQuery(id).height()/2);
				jQuery(id).css('left', winW/2-jQuery(id).width()/2);
			
				jQuery(id).fadeIn(); 

			}


		}
	});
	
};











	


