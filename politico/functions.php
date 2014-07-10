<?php

include 'config/register_post_types.php';
include 'config/enqueue_scripts.php';
include 'config/register_taxonomy.php';
include 'config/edit_columns.php';
include 'config/add_metabox.php';
include 'config/save_postmeta.php';
include 'projetos/projetos.php';
include 'perfis/perfis.php';

global $post; 

add_filter('show_admin_bar', '__return_false');
add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );
register_nav_menu( 'principal', 'menu principal' );

add_action('wp_ajax_verify_login', 'verify_login');
add_action('wp_ajax_nopriv_verify_login', 'verify_login');


function verify_login()
	{


		$acao = $_POST['acao'];
		$id_votado = $_POST['id_votado'];

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
					$percent["curtiu"] = $perfis->getCurtiu_percent();
					$percent["naocurtiu"] = $perfis->getNaoCurtiu_percent();
					break;

				case "naocurtir":
					$perfis->setCurtiu_percent();
					$perfis->setNaocurtiu_percent();
					$percent["curtiu"] = $perfis->getCurtiu_percent();
					$percent["naocurtiu"] = $perfis->getNaoCurtiu_percent();
					break;
				case "positivar_projeto":
					$projetos->setPositivar_percent();
					$projetos->setNegativar_percent();
					$percent["positivou"] = $projetos->getPositivar_percent();
					$percent["negativou"] = $projetos->getNegativar_percent();
					break;
				case "negativar_projeto":
					$projetos->setPositivar_percent();
					$projetos->setNegativar_percent();
					$percent["positivou"] = $projetos->getPositivar_percent();
					$percent["negativou"] = $projetos->getNegativar_percent();
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




function wpbootstrap_scripts_with_jquery()
{
	// Register the script like this for a theme:
	wp_register_script( 'custom-script', get_template_directory_uri() . '/bootstrap/js/bootstrap.js', array( 'jquery' ), '1.0', true );
	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'custom-script' );

}

add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );



	

function auto_insert_excerpt(){
	$post_data = &$_POST;
	$post_content = $post_data['content'];
	$length = 25;

	// This will return the first $length number of CHARACTERS
	//$output = (strlen($post_content) > 13) ? substr($post_content,0,$length).'...' : $post_content;

	// This will return the first $length number of WORDS
	$post_content_array = explode(' ',$post_content);
	if(count($post_content_array) > $length && $length > 0)
		$output = implode(' ',array_slice($post_content_array, 0, $length)).'...';

	return $output;
}
add_filter('excerpt_save_pre', 'auto_insert_excerpt');




function wpmayor_filter_image_sizes( $sizes) {

unset( $sizes['medium']);
unset( $sizes['large']);


return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'wpmayor_filter_image_sizes');

add_image_size( 'custom', 300, 300, true );




add_filter('comment_form_default_fields', 'url_filtered');
function url_filtered($fields)
{
  if(isset($fields['url']))
   unset($fields['url']);
  return $fields;
}


add_filter( 'comment_form_defaults', 'cd_pre_comment_text' );


function cd_pre_comment_text( $arg ) {
  $arg['comment_notes_before'] = "Want to see your ugly mug by your comment? Get a free custom avatar at <a href='http://www.gravatar.com' target='_blank' >Gravatar</a>.";
  return $arg;
}



class Comment_Says_Custom_Text_Wrangler {
	function comment_says_text($translation, $text, $domain) {
	
	$ID = get_the_ID();

	$comment_id = get_comment_ID();
	$author = get_comment( $comment_id );

	$quem_positivou = get_post_meta( $post_id, 'positivar_projeto', true);
	$quem_negativou = get_post_meta( $post_id, 'negativar_projeto', true);

	if (!empty($quem_positivou)) {
		
		if (in_array($author , $quem_positivou )) {
			$voto = "Apoia";
		}
		elseif (in_array($author , $quem_negativou)) {
			$voto = "Não Apoia";
		}
		else
		{
			$voto = "Não Votou";
		}
	}
	else
	{
		if (!empty($quem_negativou)) 
		{
			if (in_array($author , $quem_negativou )) 
			{
				$voto = "Não Apoia";
			}
			else
			{
			$voto = "Não Votou";
			}
		}
		else
		{
			$voto = "Não Votou";
		}

	}


	$new_says = ' - <span class="voto-comment">' . $voto . '</span> ' ;//whatever you want to have instead of 'says' in comments
    $translations = &get_translations_for_domain( $domain );
    if ( $text == '<cite class="fn">%s</cite> <span class="says">says:</span>' ) {
	   if($new_says) $new_says = ' '.$new_says; //compensate for the space character
       return $translations->translate( '<cite class="fn">%s</cite><span class="says">'.$new_says.' - </span>' );
     } else {
    return $translation; // standard text
	 }  
	}
}
add_filter('gettext', array('Comment_Says_Custom_Text_Wrangler', 'comment_says_text'), 10, 4);





?>

