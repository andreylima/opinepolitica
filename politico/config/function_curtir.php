<?php




add_action('wp_ajax_verify_login', 'verify_login');
add_action('wp_ajax_nopriv_verify_login', 'verify_login');



function verify_login()
	{
		check_ajax_referer( 'debate_nonce', 'security' );

		$acao = sanitize_text_field($_POST['acao']);
		$id_votado = sanitize_text_field($_POST['id_votado']);

		if ( is_user_logged_in() ) { 

			switch ($acao) {

				case "curtir":
					$perfis = new perfisModel($id_votado);
					$perfis->curtir();
					break;

				case "naocurtir":
					$perfis = new perfisModel($id_votado);
					$perfis->naocurtir();
					break;
				case "positivar_projeto":
					$projetos = new projetosModel($id_votado);
					$projetos->positivar_projeto();
					break;
				case "negativar_projeto":
					$projetos = new projetosModel($id_votado);
					$projetos->negativar_projeto();
					break;
			}


			switch ($acao) {

				case "curtir":
					$perfis->setCurtiu_percent();
					$perfis->setNaocurtiu_percent();
					$perfis->set_total_votos();
					$percent["curtiu"] = $perfis->getCurtiu_percent();
					$percent["naocurtiu"] = $perfis->getNaoCurtiu_percent();
					$percent["total_votos"] = $perfis->get_total_votos();
					break;

				case "naocurtir":
					$perfis->setCurtiu_percent();
					$perfis->setNaocurtiu_percent();
					$perfis->set_total_votos();
					$percent["curtiu"] = $perfis->getCurtiu_percent();
					$percent["naocurtiu"] = $perfis->getNaoCurtiu_percent();
					$percent["total_votos"] = $perfis->get_total_votos();
					break;
				case "positivar_projeto":
					$projetos->setPositivar_percent();
					$projetos->setNegativar_percent();
					$projetos->set_total_votos();
					$percent["positivou"] = $projetos->getPositivar_percent();
					$percent["negativou"] = $projetos->getNegativar_percent();
					$percent["total_votos"] = $projetos->get_total_votos();
					break;
				case "negativar_projeto":
					$projetos->setPositivar_percent();
					$projetos->setNegativar_percent();
					$projetos->set_total_votos();
					$percent["positivou"] = $projetos->getPositivar_percent();
					$percent["negativou"] = $projetos->getNegativar_percent();
					$percent["total_votos"] = $projetos->get_total_votos();
					break;
			}


			
			   $percent["logged"] = true;
			   echo json_encode($percent);
			
			exit;

		}
		else
		{
			$percent["logged"] = false;
			echo json_encode($percent);	
			exit;

		}

	} 




?>