<?php

add_action( 'save_projeto', 'save_projeto_postmeta' );
add_action( 'publish_projeto', 'save_projeto_postmeta' );

add_action( 'save_perfil', 'save_perfil_postmeta' );
add_action( 'publish_perfil', 'save_perfil_postmeta' );

add_action( 'save_debate', 'save_debate_postmeta' );
add_action( 'publish_debate', 'save_debate_postmeta' );

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
    
   

    if( isset( $_POST['autoria'] ) )
      update_post_meta( $post_id, 'autoria', $_POST['autoria']);

     if( isset( $_POST['data_proposta'] ) )
      update_post_meta( $post_id, 'data_proposta', $_POST['data_proposta']);


    if( isset( $_POST['situacao'] ) )
      update_post_meta( $post_id, 'situacao', $_POST['situacao']);

    
   if( isset( $_POST['consideracoes'] ) )
      update_post_meta( $post_id, 'consideracoes', $_POST['consideracoes']);
   

    $projetos_debatidos = get_post_meta( $_POST['autoria'], 'projetos_debatidos', true );
    if (!in_array($post_id , $projetos_debatidos))
    $projetos_debatidos[] = $post_id;
  
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




?>