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



    jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Letters only please"); 



jQuery("#log-form").validate({

 rules: {
            
            email_log: {
                required: true,
                email: true
            },
            senha_log: "required"
                       
        },
        
        // Specify the validation error messages
        messages: {
            
            email_log: {
                required: "Favor inserir seu e-mail",
                email: "E-mail inválido"
            },
            senha_log: "Digitar senha"
            
        },
        errorPlacement: function(error, element) {
        
            
        element.css("background-color","rgb(241, 255, 168)");
        element.css("border","solid 2px red");
        
        
        
    },
        
        submitHandler: function(form) {

            log_user("full");
            
        }

});


jQuery("#log-form-mobile").validate({

 rules: {
            
            email_log: {
                required: true,
                email: true
            },
            senha_log: "required"
                       
        },
        
        // Specify the validation error messages
        messages: {
            
            email_log: {
                required: "Favor inserir seu e-mail",
                email: "E-mail inválido"
            },
            senha_log: "Digitar senha"
            
        },
        errorPlacement: function(error, element) {
        
            
        element.css("background-color","rgb(241, 255, 168)");
        element.css("border","solid 2px red");
        
        
        
    },
        
        submitHandler: function(form) {

            log_user("mobile");
            
        }

});


jQuery("#formLogin").validate({

 rules: {
            
            email_log: {
                required: true,
                email: true
            },
            senha_log: "required"
                       
        },
        
        // Specify the validation error messages
        messages: {
            
            email_log: {
                required: "Favor inserir seu e-mail",
                email: "E-mail inválido"
            },
            senha_log: "Digitar senha"
            
        },
        errorPlacement: function(error, element) {
        
            
        element.css("background-color","rgb(241, 255, 168)");
        element.css("border","solid 2px red");
        
        
        
    },
        
        submitHandler: function(form) {

            log_user("modal");
            
        }

});




jQuery("#cadastro_form").validate({
    
        // Specify the validation rules
        rules: {
            nome: {
                required: true,
                lettersonly: true
            },
            sobrenome:{
                required: true,
                lettersonly: true
            },
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
            nome:{
                required: "Nome Obrigatório",
                lettersonly: "Somente letras são permitidas"  
            } ,
            sobrenome:{
                required: "Sobrenome Obrigatório",  
                lettersonly: "Somente letras são permitidas" 
            } ,
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

        	cadastrar_usuario("full");
            
        }
    });




jQuery("#cadastro_form_mobile").validate({
    
        // Specify the validation rules
        rules: {
            nome: {
                required: true,
                lettersonly: true
            },
            sobrenome:{
                required: true,
                lettersonly: true
            },
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
           nome:{
                required: "Nome Obrigatório",
                lettersonly: "Somente letras são permitidas"  
            } ,
            sobrenome:{
                required: "Sobrenome Obrigatório",  
                lettersonly: "Somente letras são permitidas" 
            } ,
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
        	
            cadastrar_usuario("mobile");
        }
    });


function cadastrar_usuario(size)
{
    if (size == "mobile") {
        var user_data = jQuery('#cadastro_form_mobile').serialize();

              jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                data: user_data + '&action=savedata'+'&security='+myAjax.ajax_nonce,
                success: function(response) {

                    console.log(response);

                    if (response != true) {

                        jQuery("#email_mobile").val("");
                        jQuery("#email_mobile").attr("placeholder",response);
                        jQuery("#email_mobile").removeClass("valid");
                        jQuery("#email_mobile").css("border", "solid 2px red");

                        return;

                    }
                    

                    location.reload(true);

                    event.preventDefault();
                }
            });

    }
    else
    {
        var user_data = jQuery('#cadastro_form').serialize();


            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                data: user_data + '&action=savedata'+'&security='+myAjax.ajax_nonce,
                success: function(response) {

                    console.log(response);

                    if (response != true) {

                        jQuery("#email").val("");
                        jQuery("#email").attr("placeholder",response);
                        jQuery("#email").removeClass("valid");
                        jQuery("#email").css("border", "solid 2px red");

                        return;

                    }
                    

                    location.reload(true);

                    event.preventDefault();
                }
            });

    }


}

function log_user(size)
{
    switch(size)  
    {
        case "mobile":
        var user_data = jQuery('#log-form-mobile').serialize();
        break;

        case "full":
        var user_data = jQuery('#log-form').serialize();
        break;

        case "modal":
        var user_data = jQuery('#formLogin').serialize();
    }


            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                data: user_data + '&action=login_user'+'&security='+myAjax.ajax_nonce,
                success: function(response) {

                    console.log(response);

                    if (response != true) {

                        if (size == "modal") {

                        jQuery(".show-error-modal").css("display", "block");
                        jQuery(".show-error-modal").html(response);   
                        return;
                        };

                        jQuery(".show-error").css("display", "block");
                        jQuery(".show-error").html(response);
                        

                        return;

                    }
                    

                    location.reload(true);

                    event.preventDefault();
                }
            });

}



// function cadastro_face(first_name, last_name, email, gender)
// {
    
//     var user_data = {"first_name":first_name, "last_name":last_name,"email":email,"gender":gender }

//      jQuery.ajax({
//                 type: 'POST',
//                 url: myAjax.ajaxurl,
//                 data: user_data + '&action=login_user'+'&security='+myAjax.ajax_nonce,
//                 success: function(response) {

//                     console.log(response);

                    
                        

//                         return;

                    
                    

//                     location.reload(true);

//                     event.preventDefault();
//                 }
//             });
// }
