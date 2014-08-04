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
include 'config/add_pdf.php';
include 'config/users.php';
include 'config/function_curtir.php';
include 'config/send_emails.php';



global $post; 

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


?>

