window.onload=function(){

jQuery('#cadastro_form').submit(function(events){
		
		alert("teste");
		// var senha = jQuery("#senha").value;
		// var conf_senha = jQuery("#conf-senha").value;
		// if (senha != conf_senha) {
		// 	jQuery("#conf-senha").attr("placeholder","Erro na confirmação da <senha class=""></senha>")
		// 	return;
		// };

		// cadastrar(events);
		events.preventDefault();	
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

