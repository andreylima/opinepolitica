<?php

include 'config/register_post_types.php';
include 'config/enqueue_scripts.php';
include 'config/register_taxonomy.php';
include 'config/edit_columns.php';
include 'config/add_metabox.php';
include 'config/save_postmeta.php';
include 'config/add_filters.php';
include 'projetos/projetos.php';
include 'perfis/perfis.php';
include 'config/add_pdf.php';

global $post; 

add_filter('show_admin_bar', '__return_false');
add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );


	function register_my_menus() {
			register_nav_menus(
				array(
					'logged_in' => 'Logado' ,
					'logged_out' => 'Não logado',
					'interno' => 'Interno',
					'mobile' => 'Mobile'
					)
				);
		}
add_action( 'init', 'register_my_menus' );

add_action('wp_ajax_verify_login', 'verify_login');
add_action('wp_ajax_nopriv_verify_login', 'verify_login');

add_action('wp_ajax_savedata', 'savedata');
add_action('wp_ajax_nopriv_savedata', 'savedata');

add_action('wp_ajax_login_user', 'login_user');
add_action('wp_ajax_nopriv_login_user', 'login_user');

add_action('wp_ajax_cadastro_faceuser', 'cadastro_faceuser');
add_action('wp_ajax_nopriv_cadastro_faceuser', 'cadastro_faceuser');

add_action('wp_ajax_send_email_contato', 'send_email_contato');
add_action('wp_ajax_nopriv_send_email_contato', 'send_email_contato');


add_action('wp_logout',create_function('','wp_redirect(home_url());exit();'));




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
					$percent["positivou"] = $projetos->getPositivar_percent();
					$percent["negativou"] = $projetos->getNegativar_percent();
					$percent["total_votos"] = $projetos->get_total_votos();
					break;
				case "negativar_projeto":
					$projetos->setPositivar_percent();
					$projetos->setNegativar_percent();
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



	function savedata()
	{
		check_ajax_referer( 'debate_nonce', 'security' );


		$nome = sanitize_text_field($_POST['nome']);
		$sobrenome = sanitize_text_field($_POST['sobrenome']);
		$email = sanitize_email($_POST['email']);
		$cpf = intval($_POST['cpf']);
		$sex = sanitize_text_field($_POST['sex']);
		$cidade = sanitize_text_field($_POST['cidade_select']);
		$senha = sanitize_text_field($_POST['senha']);

		

		$userdata = array(
			'user_login'  =>  $email,
			'user_pass'   =>  $senha,
			'user_nicename' =>  $nome,
			'user_email' => $email,
			'display_name' => $nome,
			'nickname' => $nome,
			'first_name' => $nome,
			'last_name' => $sobrenome,

    );

		$user_id = wp_insert_user( $userdata );

		if (is_wp_error( $user_id )) {
			echo $user_id->get_error_message();
			die();
		}

		update_user_meta( $user_id, "cpf" , $cpf );
		update_user_meta( $user_id, "cidade" , $cidade );
		update_user_meta( $user_id, "sexo" , $sex );

		$creds = array();
		$creds['user_login'] = $email;
		$creds['user_password'] = $senha;
		$creds['remember'] = true;

		$signon = wp_signon( $creds, false );
		wp_set_current_user( $user_id, $nome );

		echo true;
		die();

	}

	function login_user()
	{
		check_ajax_referer( 'debate_nonce', 'security' );

		$email = sanitize_email($_POST['email_log']);
		$senha = sanitize_text_field($_POST['senha_log']);

		$creds = array();
		$creds['user_login'] = $email;
		$creds['user_password'] = $senha;
		$creds['remember'] = true;

		$signon = wp_signon( $creds, false );

		if( is_wp_error( $signon ) ) {
    		echo $signon->get_error_message();
		}
		else
		{
			echo true;
		}


		die();

	}

	function cadastro_faceuser()
	{
		check_ajax_referer( 'debate_nonce', 'security' );

		$first_name = sanitize_text_field($_POST['first_name']);
		$last_name = sanitize_text_field($_POST['last_name']);
		$email = sanitize_email($_POST['email']);
		$gender = sanitize_text_field($_POST['gender']);

		if ( email_exists( $email ))
		{
			$user_id = get_user_by( 'email', $email )->ID;
			wp_set_auth_cookie( $user_id, true);
			echo "authenticated";
			die();
		}
		else
		{
			echo "nao existe";
			die();
		}


		
	}

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


?>

