<?php
add_action('wp_ajax_send_email_contato', 'send_email_contato');
add_action('wp_ajax_nopriv_send_email_contato', 'send_email_contato');




	function send_email_contato()
	{
		check_ajax_referer( 'debate_nonce', 'security' );




		$nome = sanitize_text_field($_POST['nome']);
		$email = sanitize_email($_POST['email']);
		$subject = sanitize_text_field($_POST['assunto']);
		$content = 'Mensagem de: '.$nome.'<'.$email.'> = '. sanitize_text_field($_POST['mensagem']);
		$headers = 'From: form-contato <contato@debategv.com.br>';
		$to = "contato@debategv.com.br";
		
		

		$status = wp_mail($to, $subject, $content, $headers);


				

		echo $status;
		die();

	}



	function send_email_denuncia()
	{
		


		
		$subject = 'Denúncia Realizada';
		$content = 'Uma denúncia foi registrada no site. Faça login para aprová-la.';
		$headers = 'From: form-contato <contato@debategv.com.br>';
		$to = "contato@debategv.com.br";
		
		

		$status = wp_mail($to, $subject, $content, $headers);


				

		echo $status;
		die();

	}


?>