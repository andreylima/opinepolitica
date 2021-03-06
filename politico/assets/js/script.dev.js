


// Ajax_forms


    jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-zA-Z\s]*$/.test(value);
}, "Somente letras são permitidas");

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
                  },
            sobrenome:{
                required: true,
                lettersonly: true
            },
            email: {
                required: true,
                email: true
            },
            senha: "required",
            termos: "required"

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
            senha: "Favor escolher uma senha",
            termos: "Obrigatório"

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


jQuery("#contato_form").validate({

        // Specify the validation rules
        rules: {
            nome: {
                required: true,
                lettersonly: true

            },
            email: {
                required: true,
                email: true
            },
            assunto:
            {
                required: true,
                lettersonly: true
            },
            mensagem: "required"


        },

        // Specify the validation error messages
        messages: {
           nome:{
                required: "Nome Obrigatório",
                lettersonly: "somente letras"
            } ,
            email: {
                required: "Favor inserir seu e-mail",
                email: "E-mail inválido"
            },
            assunto:
            {
                required: "Favor preencher assunto",
                lettersonly: "Somente letras são permitidas"

            },
            mensagem: "Favor inserir uma mensagem"

        },
        errorPlacement: function(error, element) {

        element.css("background-color","rgb(241, 255, 168)");
        element.css("border","solid 2px red");


    },

        submitHandler: function(form) {


            send_contact_form();
        }
    });

jQuery("#reclam_form").validate({

 rules: {

            reclamacao_title: "required",
            descricao_reclamacao: "required",
            file: "required",


        },

        // Specify the validation error messages
        messages: {

            reclamacao_title: "",
            descricao_reclamacao: "",
            file:""

        },
        errorPlacement: function(error, element) {


        element.css("background-color","rgb(241, 255, 168)");
        element.css("border","solid 2px red");



    },

        submitHandler: function(form) {

            jQuery(".reclamacao-type").removeClass("display-block");
            jQuery(".reclamacao-size").removeClass("display-block");
            jQuery(".reclamacao-error").removeClass("display-block");
            jQuery(".reclamacao-endereco").removeClass("display-block");
            save_reclamacao_ajax();

        }

});




function cadastrar_usuario(size)
{
    if (size == "mobile") {
        var user_data = jQuery('#cadastro_form_mobile').serialize();


    }
    else
    {
        var user_data = jQuery('#cadastro_form').serialize();

    }

              jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                data: user_data + '&action=savedata'+'&security='+myAjax.ajax_nonce,
                success: function(response) {

                    console.log(response);

                    if (response != true) {

                        jQuery(".email_validate").val("");
                        jQuery(".email_validate").attr("placeholder",response);
                        jQuery(".email_validate").removeClass("valid");
                        jQuery(".email_validate").css("border", "solid 2px red");

                        return;

                    }


                    location.reload(true);

                    event.preventDefault();
                }
            });

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



function send_contact_form() {

jQuery('#contato_form').find(':input:disabled').removeAttr('disabled');
var user_data = jQuery('#contato_form').serialize();


    jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                data: user_data + '&action=send_email_contato'+'&security='+myAjax.ajax_nonce,
                success: function(response) {

                   if (response == true) {


                        jQuery('#nome').val("");
                        jQuery('#email').val("");
                        jQuery('#assunto').val("");
                        jQuery('#mensagem').val("Sua mensagem foi enviada, muito obrigado. Sinta-se a vontade para enviar quantas sugestões quiser.");

                    }

                    console.log(response);
                    event.preventDefault();
                }
            });


}


// Custom_changes

window.onload=function(){

jQuery(".open_menu").click(function(){

    if (jQuery("#menu-body").hasClass("show-menu")) {
        jQuery("#menu-body").removeClass("show-menu");
        jQuery("#destaque").removeClass("destaque-fit");
        jQuery("#archive-wrapper").removeClass("archive-wrapper-fit");
        jQuery("#page-wrapper").removeClass("page-wrapper-fit");
        jQuery("#single-wrapper").removeClass("single-wrapper-fit");

    }
    else
    {
        jQuery("#menu-body").addClass("show-menu");
        jQuery("#destaque").addClass("destaque-fit");
        jQuery("#archive-wrapper").addClass("archive-wrapper-fit");
        jQuery("#page-wrapper").addClass("page-wrapper-fit");
        jQuery("#single-wrapper").addClass("single-wrapper-fit");
    };

});

jQuery(".log-out").click(function(){

     FB.getLoginStatus(function(response) {
        if (response && response.status === 'connected') {
            FB.logout(function(response) {
                document.location.reload();
            });
        }
    });


});


jQuery('.projetos-slider').flicker();
jQuery('.vereadores-slider').flicker();



if (jQuery(window).width() <= 480) {

    jQuery(".user-logged").click(function(){

        if (jQuery(".user-menu").hasClass("display-block")) {
            jQuery(".user-menu").removeClass("display-block");
        }
        else
        {
            jQuery(".user-menu").addClass("display-block");
        }




    });

};



jQuery("#menu-body ul li a").append("<i class='fa fa-arrow-right arrow-margin'></i>");





jQuery(".check_aceito").click( function(){

var id = '#modal-termos';

                var maskHeight = jQuery(document).height();
                var maskWidth = jQuery(window).width();

                jQuery('#mask').css({'width':maskWidth,'height':maskHeight});

                jQuery('#mask').fadeIn();
                jQuery('#mask').fadeTo('fast',0.5);

                    //Get the window height and width
                var winH = jQuery(window).height();
                var winW = jQuery(window).width();

                jQuery(id).css('top',  "15%");
                jQuery(id).css('left', "5%");

                jQuery(id).fadeIn();

});


jQuery('#modal-termos .close').click(function (e) {
        e.preventDefault();

        jQuery('#mask').hide();
        jQuery('#modal-termos').hide();
    });

jQuery('#mask').click(function () {
        jQuery(this).hide();
        jQuery('#modal-termos').hide();
    });

}



// Fixed


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


// Login_modal



  jQuery(function ($) {

$('.window .close').click(function (e) {
        e.preventDefault();

        $('#mask').hide();
        $('.window').hide();
    });

    $('#mask').click(function () {
        $(this).hide();
        $('.window').hide();
    });

        $('#register-manual').click(function() {


            width = $(window).width();

            if (width <= 480) {
                window.location = "#cadastro-wrapper-footer";
                $('#mask').hide();
                $('.window').hide();
                return false;
            }
            window.location = "#destaque";
                $('#mask').hide();
                $('.window').hide();

        });



        $('#register-manual-inside').click(function() {


                window.location = "http://www.debategv.com.br";
                $('#mask').hide();
                $('.window').hide();



        });




});







function setCookie(name, value, daysToLive) {
    var expirationDate = new Date();
    expirationDate.setDate(expirationDate.getDate() + daysToLive);
    document.cookie = name + '=' + escape(value) + ((daysToLive == null) ? '' : '; expires=' + expirationDate.toUTCString());
}

function getCookie(name) {
    var cookies=document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        if (cookies[i].substr(0, cookies[i].indexOf('=')).replace(/^\s+|\s+$/g, '') == name) {
            return unescape(cookies[i].substr(cookies[i].indexOf('=') + 1));
        }
    }
}

//face-connect

// jQuery(".face-link").attr("href",jQuery(".wsl_connect_with_provider").attr("href"));

jQuery(".entrar-button").click(function(){

if (jQuery(".login-connect-header").hasClass("login-connect-header-clicked")) {

    jQuery(".login-connect-header").removeClass("login-connect-header-clicked");
    jQuery(".login-buttons").removeClass("show-menu");
    jQuery("#log-form").removeClass("show-menu");
    jQuery(".login-buttons").removeClass("hide");
    jQuery(".flaticon-user60").removeClass("color-avatar");

}
else
{
    jQuery(".login-connect-header").addClass("login-connect-header-clicked");
    jQuery(".login-buttons").addClass("show-menu");
    jQuery(".flaticon-user60").addClass("color-avatar");


}

});


jQuery(".login-with-email").click(function(){

jQuery(".login-buttons").addClass("hide");

jQuery("#log-form").addClass("show-menu");


});

jQuery(".flaticon-back36").click(function(){

jQuery("#log-form").removeClass("show-menu");

jQuery(".login-buttons").removeClass("hide");

});


jQuery(".register-with-email").click(function(){

if (jQuery("#cadastro_form").hasClass("show-menu")) {

    jQuery("#cadastro_form").removeClass("show-menu");
}
else
{
    jQuery("#cadastro_form").addClass("show-menu");
}

});

//chosen


jQuery('.chosen-select').chosen({inherit_select_classes : true});

var filters = {};

jQuery('.chosen-select').change(function(event){

     if(event.target == this){

        if (jQuery(this).parent().hasClass('filtro-projetos')) {



          // get group key
          var buttonGroup = jQuery("option:selected", this).parents('.chosen-select');
          var filterGroup = buttonGroup.attr('data-filter-group');
          // set filter for group
          filters[ filterGroup ] = jQuery("option:selected", this).attr('data-filter');
          // combine filters
          var filterValue = '';
          for ( var prop in filters ) {
            filterValue += filters[ prop ];
        }
          // set filter for Isotope

          jQuery('#container').isotope({ filter: filterValue });
          // jQuery('#container').isotope({ filter: jQuery(this).val() })



        }
        else if (jQuery(this).parent().hasClass('filtro-perfis'))
        {



          // get group key
          var buttonGroup = jQuery("option:selected", this).parents('.chosen-select');
          var filterGroup = buttonGroup.attr('data-filter-group');
          // set filter for group
          filters[ filterGroup ] = jQuery("option:selected", this).attr('data-filter');
          // combine filters
          var filterValue = '';
          for ( var prop in filters ) {
            filterValue += filters[ prop ];
        }
          // set filter for Isotope

          jQuery('#perfis').isotope({ filter: filterValue });
          // jQuery('#container').isotope({ filter: jQuery(this).val() })


        };




     }

});

//trombone

jQuery('#bairro_reclamacao').chosen({inherit_select_classes : false});


jQuery(document).ready(function() {



jQuery(".reclamacao-title").focus(function()
{
    if (jQuery("#addressField").val() == "") {
        jQuery(".aviso-local").addClass("display-block");

    }
    else
    {
        jQuery(".aviso-local").removeClass("display-block");

    }
})

jQuery(".reclamacao-title").focusout(function()
{
    if (jQuery("#addressField").val() == "") {
        jQuery(".aviso-local").addClass("display-block");

    }
    else
    {
        jQuery(".aviso-local").removeClass("display-block");

    }
})




});

var request_count = 0;

function save_reclamacao_ajax()
{

if (request_count != 1) {
var formElement = document.getElementById("reclam_form");
var formData = new FormData(reclam_form);
formData.append("action", "save_reclamacao");
formData.append("security",myAjax.ajax_nonce);



  var xhr = new XMLHttpRequest();

  xhr.open("POST",myAjax.ajaxurl,true);
  xhr.send(formData);

   xhr.onreadystatechange=function(){

    if (xhr.readyState==4 && xhr.status==200){
console.log(xhr.responseText);

switch(xhr.responseText)
{
    case "endereco":
     jQuery(".reclamacao-endereco").addClass("display-block");
     window.scrollTo(0,document.body.scrollHeight);
     break;
    case "type":
    jQuery(".reclamacao-type").addClass("display-block");
    window.scrollTo(0,document.body.scrollHeight);
    break;
    case "size":
    jQuery(".reclamacao-size").addClass("display-block");
    window.scrollTo(0,document.body.scrollHeight);
    break;
    case "error":
    jQuery(".reclamacao-error").addClass("display-block");
    window.scrollTo(0,document.body.scrollHeight);
    break;
    default:
     jQuery(".reclamacao-title").val('');
    jQuery(".descricao_reclamacao").val('');
    jQuery(".obs-bairro").val('');
    jQuery("#file").val("");
    jQuery(".reclamacao-sucesso").addClass("display-block");
    window.scrollTo(0,document.body.scrollHeight);
    request_count = 1;
    break;

};





    }
  }






                    event.preventDefault();

}

}

