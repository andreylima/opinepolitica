<?php

include 'config/register_post_types.php';
include 'config/enqueue_scripts.php';
include 'config/register_taxonomy.php';
include 'config/edit_columns.php';
include 'config/add_metabox.php';
include 'config/save_postmeta.php';
include 'config/add_filters.php';
include 'projetos/projetos.php';
include 'perfis/perfis.php';
include 'trombone/trombone.php';
include 'config/add_pdf.php';
include 'config/users.php';
include 'config/function_curtir.php';
include 'config/send_emails.php';



global $post;
global $wpdb;

add_filter('show_admin_bar', '__return_false');
add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );

add_action('wp_logout',create_function('','wp_redirect(home_url());exit();'));



	function register_my_menus() {
			register_nav_menus(
				array(
					'logged_in' => 'Logado' ,
					'logged_out' => 'Não logado',
					'interno' => 'Interno',
					'mobile' => 'Mobile'
					)
				);
		}
add_action( 'init', 'register_my_menus' );


add_action( 'widgets_init', 'my_register_sidebars' );
function my_register_sidebars() {
	register_sidebar(
		array(
			'id' => 'primary',
			'name' => __( 'Primary' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);
}




	function my_login_logo() { ?>
	<style type="text/css">
	body.login div#login h1 a {
		background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo400x400.png);
		padding-bottom: 30px;
	}
	</style>
	<?php }
	add_action( 'login_enqueue_scripts', 'my_login_logo' );

	function my_login_logo_url() {
		return home_url();
	}
	add_filter( 'login_headerurl', 'my_login_logo_url' );

	function my_login_logo_url_title() {
		return 'DebateGV';
	}
	add_filter( 'login_headertitle', 'my_login_logo_url_title' );




add_filter( 'add_menu_classes', 'show_pending_number');
function show_pending_number( $menu ) {
    $type = "reclamacao";
    $status = "pending";
    $num_posts = wp_count_posts( $type, 'readable' );
    $pending_count = 0;
    if ( !empty($num_posts->$status) )
        $pending_count = $num_posts->$status;

    // build string to match in $menu array
    if ($type == 'post') {
        $menu_str = 'edit.php';
    } else {
        $menu_str = 'edit.php?post_type=' . $type;
    }

    // loop through $menu items, find match, add indicator
    foreach( $menu as $menu_key => $menu_data ) {
        if( $menu_str != $menu_data[2] )
            continue;
        $menu[$menu_key][0] .= " <span class='update-plugins count-$pending_count'><span class='plugin-count'>" . number_format_i18n($pending_count) . '</span></span>';
    }
    return $menu;
}


?>