<?php


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

?>