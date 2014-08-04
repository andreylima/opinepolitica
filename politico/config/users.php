<?php

add_action('wp_ajax_savedata', 'savedata');
add_action('wp_ajax_nopriv_savedata', 'savedata');

add_action('wp_ajax_login_user', 'login_user');
add_action('wp_ajax_nopriv_login_user', 'login_user');

add_action('wp_ajax_cadastro_faceuser', 'cadastro_faceuser');
add_action('wp_ajax_nopriv_cadastro_faceuser', 'cadastro_faceuser');




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


?>