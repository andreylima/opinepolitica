<?php

add_action( 'init', 'register_post_types' );


/**
 * Registra novos tipos de conteúdo personalizados.
 * 
 * NOTA: Não se esqueça de sempre que registrar um novo post type entrar na edição
 * de links permanentes para reescrever a url do novo post type.
 * 
 * @return void
 */
function register_post_types()
{
    register_post_type( 
        'perfil',
        array(
            'labels' => array(
                'name'          => 'Perfis',
                'singular_name' => 'Perfil',
                'search_items'  => 'Pesquisar Perfis',
                'add_new_item'  => 'Adicionar novo Perfil',
                'add_new'       => 'Adicionar Perfil',
                'all_items'     => 'Todos os Perfis',
                'edit_item'     => 'Editar Perfil',
            ),
            'public'      => true,
            'supports'    => array( 'title', 'editor', 'thumbnail', 'taxonomies'),
            'has_archive' => true,
            'taxonomies'  => array( 'category')
        )
    );

    register_post_type( 
        'projeto',
        array(
            'labels' => array(
                'name'          => 'Projetos de Lei',
                'singular_name' => 'Projeto de Lei',
                'search_items'  => 'Pesquisar Projetos de Lei',
                'add_new_item'  => 'Adicionar novo Projeto de Lei',
                'add_new'       => 'Adicionar Projeto de Lei',
                'all_items'     => 'Todos os Projetos',
                'edit_item'     => 'Editar Projeto',
            ),
            'public'      => true,
            'supports'    => array( 'title', 'editor', 'thumbnail', 'taxonomies','excerpt','comments' ),
            'has_archive' => true,
            'taxonomies'  => array( 'category')
        )
    );

   
    }

?>