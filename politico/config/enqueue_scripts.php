<?php


add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );
// add_action( 'wp_enqueue_scripts', 'validate_scripts' );
add_action( 'init', 'ajax_curtir' );

/**
 * Adiciona e/ou gerencia os arquivos Javascript do tema
 * 
 * @return void
 */
function enqueue_scripts()
{
    wp_enqueue_script( "chosen", get_stylesheet_directory_uri() . '/assets/js/chosen.jquery.js', array('jquery'),'1.0',true );

    wp_register_script( 'isotope', get_template_directory_uri(). '/assets/js/jquery.isotope.min.js', array('jquery'),  true );
   
    wp_register_script( 'masonry.config', get_template_directory_uri() .'/assets/js/masonry.config.js' , array('jquery', 'isotope'),'1.0',true);

    wp_register_script( 'google.maps.api', get_template_directory_uri() .'/assets/js/google-maps-api.min.js' , array('jquery'),'1.0',true);

    wp_enqueue_script( "jquery-finger", get_stylesheet_directory_uri() . '/assets/js/jquery-finger-v0.1.0.js', array('jquery'),'1.0', true );

    wp_enqueue_script( "flickerplate", get_stylesheet_directory_uri() . '/assets/js/flickerplate.min.js', array('jquery'),'1.0', true );

    wp_enqueue_script( "modernizr-custom", get_stylesheet_directory_uri() . '/assets/js/modernizr-custom-v2.7.1.js', array('jquery'),'1.0', true );

     wp_enqueue_script( "jquery_validate", get_stylesheet_directory_uri() . '/assets/js/jquery.validate.js', array('jquery'),'1.0', true );

     wp_enqueue_script( "script", get_stylesheet_directory_uri() . '/assets/js/script.min.js', array('jquery'),'1.0',true );




     if( is_archive() )
    {
            
       wp_enqueue_script('masonry.config');
                
    }

         if( is_page('boca-no-trombone') or is_page('registrar-denuncia') or ( 'denuncia' == get_post_type() ) )
    {

       wp_enqueue_script('google.maps.api');
           
    }


    
}




function ajax_curtir() {

   wp_enqueue_script( "ajax_curtir",get_template_directory_uri().'/assets/js/ajax_curtir.min.js', array('jquery'), '1.0', true ); //chama a função php via ajax
   
   wp_localize_script( 'ajax_curtir', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'ajax_nonce' => wp_create_nonce('debate_nonce'),)); // localiza o arquivo que vai tratar o ajax       
   
}





  

?>