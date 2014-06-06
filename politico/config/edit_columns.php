<?php

// function pol_edit_perfil_columns( $columns ) {

//     $columns = array(
//         'cb' => '<input type="checkbox" />',
//         'title' => __( 'Nome' ),
//         'partido' => __( 'Partido' ),
//         'categories' => __( 'Cargo' )
//         );

//     return $columns;
// }

// function pol_manage_perfil_columns( $column, $post_id ) {
//     global $post;

//     switch( $column ) {

//         /* If displaying the 'n_pedido' column. */
//         case 'partido' :

//         /* Get the post meta. */
//         $terms = get_the_terms( $post->ID , 'Partidos' );
//          if (!empty($terms)) {
//              foreach ( $terms as $term ) {

//                  $partido = $term->name;

//              }
//          } 



//         /* If no n_pedido is found, output a default message. */
//         if ( empty( $terms ) )
//             echo __( 'Não informado' );

//         /* If there is a n_pedido, append 'minutes' to the text string. */
//         else
//             echo $partido;
//         break;
        
//         default :
//         break;
//     }
// }

function pol_perfil_sortable_columns( $columns ) {

    $columns['Partidos'] = 'Partidos';
    

    return $columns;
}

 function pol_edit_perfil_load() {
     add_filter( 'request', 'pol_sort_perfil' );
}

 /* Sorts the movies. */
 function pol_sort_perfil( $vars ) {

     /* Check if we're viewing the 'movie' post type. */
     if ( isset( $vars['post_type'] ) && 'perfil' == $vars['post_type'] ) {

         /* Check if 'orderby' is set to 'duration'. */
         if ( isset( $vars['orderby'] ) && 'partidos' == $vars['orderby'] ) {

             /* Merge the query vars with our custom variables. */
             $vars = array_merge(
                 $vars,
                array(
                    'meta_key' => 'partido',
                     'orderby' => 'meta_value_num'
                     )
                 );
         }
     }

     return $vars;
 }




add_action( 'load-edit.php', 'pol_edit_perfil_load' );
add_filter( 'manage_edit-perfil_sortable_columns', 'pol_perfil_sortable_columns' );
// add_action( 'manage_perfil_posts_custom_column', 'pol_manage_perfil_columns', 10, 2 );
// add_filter( 'manage_edit-perfil_columns', 'pol_edit_perfil_columns' ) ;

?>