<?php

add_action( 'save_projeto', 'save_projeto_postmeta' );
add_action( 'publish_projeto', 'save_projeto_postmeta' );

add_action( 'save_perfil', 'save_perfil_postmeta' );
add_action( 'publish_perfil', 'save_perfil_postmeta' );

add_action( 'save_denuncia', 'save_denuncia_postmeta' );
add_action( 'publish_denuncia', 'save_denuncia_postmeta' );

function save_projeto_postmeta( $post_id )
{

    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
       return;
 
    // Check permissions
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) )
            return;
    }
    else {
        if ( !current_user_can( 'edit_posts', $post_id ) )
        return;
    }
    
    // Pegamos o valor digitado pelo usuário no metabox através da variável $_POST do php
    // Utilizamos a função esc_url() para garantir a segurança dos dados antes de salvar no banco de dados
    
   

    if( isset( $_POST['autoria'] ) ) {

      $autor = get_post_meta( $post_id , 'autoria', true );
     
      if ($autor != "") {
        $projetos = get_post_meta($autor, 'projetos_debatidos', true);
        $projetos = ($projetos == '') ? array() : $projetos;
        $indice = array_search($post_id, $projetos);
        unset($projetos[$indice]);
        // die($autor);
        update_post_meta($autor, 'projetos_debatidos', $projetos);
      }


      update_post_meta( $post_id, 'autoria', $_POST['autoria']);

    }

     if( isset( $_POST['data_proposta'] ) )
      update_post_meta( $post_id, 'data_proposta', $_POST['data_proposta']);


    if( isset( $_POST['situacao'] ) )
      update_post_meta( $post_id, 'situacao', $_POST['situacao']);

    
   if( isset( $_POST['justificativa'] ) )
      update_post_meta( $post_id, 'justificativa', wpautop($_POST['justificativa']));
   


    $projetos_debatidos = get_post_meta( $_POST['autoria'], 'projetos_debatidos', true );
     
     if (!empty($projetos_debatidos)){

         if (!in_array($post_id , $projetos_debatidos))
        $projetos_debatidos[] = $post_id;
     }
     else
      {
        $projetos_debatidos[] = $post_id;
      }

   


    update_post_meta( $_POST['autoria'], 'projetos_debatidos' , $projetos_debatidos);

}

function save_perfil_postmeta($post_id) 
{

    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
       return;
 
    // Check permissions
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) )
            return;
    }
    else {
        if ( !current_user_can( 'edit_posts', $post_id ) )
        return;
    }
    
    // Pegamos o valor digitado pelo usuário no metabox através da variável $_POST do php
    // Utilizamos a função esc_url() para garantir a segurança dos dados antes de salvar no banco de dados
   
    if( isset( $_POST['mandato'] ) )
      update_post_meta( $post_id, 'mandato', $_POST['mandato']);

    

}

function save_denuncia_postmeta($post_id) 
{

    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
       return;
 
    // Check permissions
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) )
            return;
    }
    else {
        if ( !current_user_can( 'edit_posts', $post_id ) )
        return;
    }
    
    // Pegamos o valor digitado pelo usuário no metabox através da variável $_POST do php
    // Utilizamos a função esc_url() para garantir a segurança dos dados antes de salvar no banco de dados
   
    if( isset( $_POST['latitude'] ) )
      update_post_meta( $post_id, 'latitude', $_POST['latitude']);

    if( isset( $_POST['longitude'] ) )
      update_post_meta( $post_id, 'longitude', $_POST['longitude']);

    if( isset( $_POST['local_denuncia'] ) )
          update_post_meta( $post_id, 'local_denuncia', $_POST['local_denuncia']);

      if( isset( $_POST['debate_video'] ) )
         update_post_meta( $post_id, 'debate_video', $_POST['debate_video']);

       if( isset( $_POST['user-personagem'] ) )
         update_post_meta( $post_id, 'user-personagem', $_POST['user-personagem']); 

      if( isset( $_POST['situacao_denuncia'] ) )
          update_post_meta( $post_id, 'situacao_denuncia', $_POST['situacao_denuncia']);

     if( isset( $_POST['bairro_denuncia'] ) )
          update_post_meta( $post_id, 'bairro_denuncia', $_POST['bairro_denuncia']);
        
      if( isset( $_POST['obs_bairro'] ) )
          update_post_meta( $post_id, 'obs_bairro', $_POST['obs_bairro']);
}


?>