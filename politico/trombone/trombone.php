<?php


require_once 'controller/tromboneController.class.php';




add_action('wp_ajax_get_reclamacoes', 'get_reclamacoes');
add_action('wp_ajax_nopriv_get_reclamacoes', 'get_reclamacoes');

add_action('wp_ajax_save_reclamacao', 'save_reclamacao');
add_action('wp_ajax_nopriv_save_reclamacao', 'save_reclamacao');

add_action('wp_ajax_get_reclamacao', 'get_reclamacao');
add_action('wp_ajax_nopriv_get_reclamacao', 'get_reclamacao');

function get_reclamacoes()
	{

		$reclamacoes = new tromboneController();

		$reclamacao_completa = $reclamacoes->get_reclamacao_completa();


	   	echo json_encode($reclamacao_completa);

		exit;



	}

function get_reclamacao()
{

		$reclamacao = new tromboneController();

		$reclamacao->set_reclamacao_single();
		$reclamacao_single = $reclamacao->get_reclamacao_single();


	   	echo json_encode($reclamacao_single);

		exit;



}


function save_reclamacao()
	{

		check_ajax_referer( 'debate_nonce', 'security' );

		$reclamacao['endereco'] = sanitize_text_field($_POST['reclamacao-endereco']);
		$reclamacao['obs-bairro'] = sanitize_text_field($_POST['obs-bairro']);
		$reclamacao['longitude'] = sanitize_text_field($_POST['longitude']);
		$reclamacao['latitude'] = sanitize_text_field($_POST['latitude']);
		$reclamacao['reclamacao_title'] = $_REQUEST['reclamacao_title']	;
		$reclamacao['descricao_reclamacao'] = sanitize_text_field($_POST['descricao_reclamacao']);

		if ($_POST['reclamacao-endereco'] == "") {
			echo "endereco";
			exit;
		}

		 if(isset($_FILES["file"]["type"]))
		{
			$validextensions = array("jpeg", "jpg", "png");
			$temporary = explode(".", $_FILES["file"]["name"]);
			$file_extension = end($temporary);

			if (($_FILES["file"]["type"] != "image/png") && ($_FILES["file"]["type"] != "image/jpg")  && ($_FILES["file"]["type"] != "image/jpeg"))
			{
				echo "type";
				exit;
			}
			if ($_FILES["file"]["size"] > 2048000)
			{
				echo "size";
				exit;
			}
			if ($_FILES["file"]["error"] > 0)
			{
				echo "error";
				exit;
			}

		 	$reclamacao['file'] = $_FILES["file"];



		 $reclamacoes = new tromboneController();

		$reclamacao_retorno = $reclamacoes->save_reclamacao_wp($reclamacao);


		echo $reclamacao_retorno;

		exit;

		 }
		 else
		 {
			echo "error";
			exit;
		}


	}

?>
