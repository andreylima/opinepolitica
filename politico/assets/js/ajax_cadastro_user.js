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
            nome: "Nome Obrigatório",
            sobrenome: "Sobrenome Obrigatório",
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
       	
        	
		element.css("background-color","rgb(241, 255, 168)");
  		element.css("border","solid 2px red");
  		
        
        
    },
        
        submitHandler: function(form) {

        	cadastrar_usuario();
            
        }
    });




jQuery("#cadastro_form_down").validate({
    
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
            nome: "Nome Obrigatório",
            sobrenome: "Sobrenome Obrigatório",
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
       	
        element.attr("placeholder",error.text());
        element.val("");
        element.css("border","solid 2px red");
        
    },
        
        submitHandler: function(form) {
        	
            form.submit();
        }
    });


function cadastrar_usuario()
{
	var user_data = jQuery('#cadastro_form').serialize(); // <--- Important

        	jQuery.ajax({
        		type: 'POST',
        		url: myAjax.ajaxurl,
        		data: user_data + '&action=savedata',
        		success: function(response) {

        			console.log(response);

        			if (response != "1") {

        				jQuery("#email").val("");
        				jQuery("#email").attr("placeholder",response);
        				jQuery("#email").removeClass("valid");
        				jQuery("#email").css("border", "solid 2px red");

        				return;

        			}
        			else
        			{
        				
        			}

        			// location.reload(true);

        			event.preventDefault();
        		}
        	});
}

