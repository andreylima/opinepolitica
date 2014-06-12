<?php


add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );
add_action( 'init', 'ajax_initiate' );

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

    wp_enqueue_script( "jquery_validate", get_stylesheet_directory_uri() . '/assets/js/jquery-validate.js', array('jquery'),'1.0', true );

    
  	wp_enqueue_script( "jquery-finger", get_stylesheet_directory_uri() . '/assets/js/jquery-finger-v0.1.0.js', array('jquery'),'1.0', true );

  	wp_enqueue_script( "flickerplate", get_stylesheet_directory_uri() . '/assets/js/flickerplate.js', array('jquery'),'1.0', true );

    wp_enqueue_script( "modernizr-custom", get_stylesheet_directory_uri() . '/assets/js/modernizr-custom-v2.7.1.js', array('jquery'),'1.0', true );
}



function ajax_initiate() {

   wp_enqueue_script( "ajax_initiate",get_template_directory_uri().'/assets/js/ajax_initiate.js', array('jquery'), '1.0', true ); //chama a função php via ajax
   
   wp_localize_script( 'ajax_initiate', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ))); // localiza o arquivo que vai tratar o ajax       
   
}


	

?>