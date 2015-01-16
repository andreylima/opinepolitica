<?php


require_once 'controller/tromboneController.class.php';




add_action('wp_ajax_get_denuncias', 'get_denuncias');
add_action('wp_ajax_nopriv_get_denuncias', 'get_denuncias');

add_action('wp_ajax_save_denuncia', 'save_denuncia');
add_action('wp_ajax_nopriv_save_denuncia', 'save_denuncia');

add_action('wp_ajax_get_denuncia', 'get_denuncia');
add_action('wp_ajax_nopriv_get_denuncia', 'get_denuncia');

function get_denuncias()
	{
		
		$denuncias = new tromboneController();

		$denuncia_completa = $denuncias->getDenuncia_completa();

					
	   	echo json_encode($denuncia_completa);
			
		exit;

	

	}

function get_denuncia()
{
	
		$denuncia = new tromboneController();

		$denuncia->set_denuncia_single();
		$denuncia_single = $denuncia->get_denuncia_single();

					
	   	echo json_encode($denuncia_single);
			
		exit;



}


function save_denuncia()
	{
		check_ajax_referer( 'debate_nonce', 'security' );

		$denuncia['endereco'] = sanitize_text_field($_POST['denuncia-endereco']);
		$denuncia['longitude'] = sanitize_text_field($_POST['longitude']);
		$denuncia['latitude'] = sanitize_text_field($_POST['latitude']);
		$denuncia['denuncia_title'] = sanitize_text_field($_POST['denuncia_title']);
		$denuncia['descricao_denuncia'] = sanitize_text_field($_POST['descricao_denuncia']);
		$denuncia['youtube-video'] = sanitize_text_field($_POST['youtube-video']);
		$denuncia['debate-video'] = (sanitize_text_field($_POST['debate-video']) == '') ? 'nao' : sanitize_text_field($_POST['debate-video']); 
		$denuncia['user-personagem'] = (sanitize_text_field($_POST['user-personagem']) == '') ? 'nao' : sanitize_text_field($_POST['user-personagem']);

		if ($denuncia['endereco'] == "") {

			$erros = 'noadress';
			echo $erros;

			exit;
		}



		if ($denuncia['youtube-video'] == "" && $denuncia['debate-video'] =="") {
			
			$erros = 'novideo';
			echo $erros;

			exit;


		}


		$denuncias = new tromboneController();

		$denuncia_retorno = $denuncias->save_denuncia_wp($denuncia);


		echo json_encode($denuncia);
			
		exit;
		


	} 

?>
