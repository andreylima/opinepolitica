<?php


function tax_init() {
	// create a new taxonomy
	register_taxonomy(
		'Partidos',
		'perfil',
		array(
			'labels' => array(
          'name'          => 'Partidos',
          'singular_name' => 'Partido',
          'add_new_item'  => 'Adicionar Novo Partido'
        ),
			'rewrite' => array( 'slug' => 'partidos' ),
			'public'       => true,
        	'hierarchical' => true,
        	'show_admin_column' => true
			
		)
	);

register_taxonomy(
		'Cargos',
		'perfil',
		array(
			'labels' => array(
          'name'          => 'Cargos',
          'singular_name' => 'Cargo',
          'add_new_item'  => 'Adicionar Novo Cargo'
        ),
			'rewrite' => array( 'slug' => 'cargos' ),
			'public'       => true,
        	'hierarchical' => true,
        	'show_admin_column' => true
			
		)
	);

}
add_action( 'init', 'tax_init' );

?>