<?php


add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );
add_action( 'wp_enqueue_scripts', 'validate_scripts' );
add_action( 'init', 'ajax_curtir' );

/**
 * Adiciona e/ou gerencia os arquivos Javascript do tema
 * 
 * @return void
 */
function enqueue_scripts()
{


    wp_enqueue_script( "custom-changes", get_stylesheet_directory_uri() . '/assets/js/custom-changes.js', array(),'1.0',true );

    wp_enqueue_script( "fixed", get_stylesheet_directory_uri() . '/assets/js/fixed.js', array('jquery'),'1.0',true );

    wp_enqueue_script( "login_modal", get_stylesheet_directory_uri() . '/assets/js/login_modal.js', array('jquery'),'1.0', true );
  
  	wp_enqueue_script( "jquery-finger", get_stylesheet_directory_uri() . '/assets/js/jquery-finger-v0.1.0.js', array('jquery'),'1.0', true );

  	wp_enqueue_script( "flickerplate", get_stylesheet_directory_uri() . '/assets/js/flickerplate.js', array('jquery'),'1.0', true );

    wp_enqueue_script( "modernizr-custom", get_stylesheet_directory_uri() . '/assets/js/modernizr-custom-v2.7.1.js', array('jquery'),'1.0', true );


}

function validate_scripts()
{
   wp_enqueue_script( "jquery_validate", get_stylesheet_directory_uri() . '/assets/js/jquery-validate.js', array('jquery'),'1.0', true );


  wp_enqueue_script( "ajax_forms", get_stylesheet_directory_uri() . '/assets/js/ajax_forms.js', array('jquery'),'1.0',true );
}


function ajax_curtir() {

   wp_enqueue_script( "ajax_curtir",get_template_directory_uri().'/assets/js/ajax_curtir.js', array('jquery'), '1.0', true ); //chama a função php via ajax
   
   wp_localize_script( 'ajax_curtir', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'ajax_nonce' => wp_create_nonce('debate_nonce'),)); // localiza o arquivo que vai tratar o ajax       
   
}

// function wpbootstrap_scripts_with_jquery()
// {
//   // Register the script like this for a theme:
//   wp_register_script( 'custom-script', get_template_directory_uri() . '/bootstrap/js/bootstrap.js', array( 'jquery' ), '1.0', true );
//   // For either a plugin or a theme, you can then enqueue the script:
//   wp_enqueue_script( 'custom-script' );

// }

// add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );



	

?>