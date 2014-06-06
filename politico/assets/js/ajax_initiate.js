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

function validate_form()
{
	jQuery.validator.addMethod("verificaCPF", function(value, element) {
    var Soma;
    var Resto;
    Soma = 0;   
    //strCPF  = RetiraCaracteresInvalidos(strCPF,11);
    if (value == "00000000000")
	return false;
    for (i=1; i<=9; i++)
	Soma = Soma + parseInt(value.substring(i-1, i)) * (11 - i); 
    Resto = (Soma * 10) % 11;
    if ((Resto == 10) || (Resto == 11)) 
	Resto = 0;
    if (Resto != parseInt(value.substring(9, 10)) )
	return false;
	Soma = 0;
    for (i = 1; i <= 10; i++)
       Soma = Soma + parseInt(value.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
    if ((Resto == 10) || (Resto == 11)) 
	Resto = 0;
    if (Resto != parseInt(value.substring(10, 11) ) )
        return false;
    return true;
}, "Informe um CPF válido."); 
		
		jQuery("#cadastro_form").validate({
    
        // Specify the validation rules
        rules: {
            nome: "required",
            sobrenome: "required",
            email: {
                required: true,
                email: true
            },
            cpf:{
            	required:true,
            	verificaCPF: true
            },
            cidade_select: "required",
            senha: "required"
                       
        },
        
        // Specify the validation error messages
        messages: {
            nome: "O nome é obrigatório",
            sobrenome: "Favor inserir seu sobrenome",
            email: {
                required: "Favor inserir seu e-mail",
                email: "E-mail inválido"
            },
            cpf:{
            	required:"Favor inserir seu CPF",
            	verificaCPF: "CPF inválido"
            },
            senha: "Favor escolher uma senha"
            
        },
        errorPlacement: function(error, element) {
       	
        // element.attr("placeholder",error.text());
        // element.val("");
        element.css("border","solid 2px red");
        
    },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
		// var nome = jQuery("#nome").val();
		// var sobrenome = jQuery("#sobrenome").val();
		// var email = jQuery("#email").val();
		// var cpf = jQuery("#cpf").val();
		// var cidade = jQuery("#cidade").val(); 
		// var senha = jQuery("#senha").val();
		// var conf_senha = jQuery("#conf-senha").val();

		// if (nome != "" && sobrenome != "" && email !="" && cpf !="" && cidade != "" && senha !="" && conf_senha != "" ) 
		// 	{


		// 	};

		
		// if (senha != "") {

		// 	if (senha != conf_senha) 
		// 	{
		// 	jQuery("#conf-senha").val("");
		// 	jQuery("#conf-senha").attr("placeholder","Erro na confirmação da senha.");
		// 	jQuery("#conf-senha").css("border","solid red");
		// 	events.preventDefault();
		// 	};


		// }
		// else
		// {
		// 	jQuery("#senha").attr("placeholder","O campo senha é obrigatório.");
		// 	jQuery("#senha").css("border","solid red");

		// }



		

		// cadastrar(events);
		
}

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

function cadastrar(events){

	var user_data = jQuery('#cadastro_form').serialize(); // <--- Important

	jQuery.ajax({
		type: 'POST',
		url: myAjax.ajaxurl,
		data: user_data + '&action=savedata',
		success: function(response) {
		
			console.log(response);
			
			if (!response) {

				jQuery(".email").attr("placeholder",response);
				jQuery(".email").css("border", "solid red");

				return;

			};

			location.reload(true);
			
			}
	});
	
};









	


