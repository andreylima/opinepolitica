<?php


require_once 'controller/tromboneController.class.php';




add_action('wp_ajax_get_denuncias', 'get_denuncias');
add_action('wp_ajax_nopriv_get_denuncias', 'get_denuncias');



function get_denuncias()
	{
		
		$denuncias = new tromboneController();

		$denuncia_completa = $denuncias->getDenuncia_completa();

					
	   	echo json_encode($denuncia_completa);
			
		exit;

	

	} 

?>
