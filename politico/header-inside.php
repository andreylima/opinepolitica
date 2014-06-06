
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title>
	<?php
	/*
	 * Mesmo código utilizado no tema padrão do WordPress, para escrever a tag <title> do site.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";


	?>
	</title>
        <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ) ?>">
	<!--[if lte IE 8]><script type="text/javascript" src="<?php bloginfo( 'template_url' ) ?>/assets/javascript/html5.js"></script><![endif]-->
	<!--<img class="img-circle" src="http://placehold.it/140x140"> -->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
		<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=532848680162864";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
		<div> 
		<header class="row-fluid header-inside">
		<img  class="img-circle pull-left logo-inside-small" src="http://placehold.it/50x50">
		<?php
		wp_nav_menu( array( 'theme_location'=>'principal', 'container_id' => 'menu-bar', 'container_class' => 'menu-top_menu-container menu-position-inside' ) );
		?>
		<!--<div class="pull-right slogan" >
			<h4 class="text-right">Nossa liberdade não pode estar mais segura do que nas nossas próprias mãos.</h4>
			<h5 class="text-right">Thomas Jefferson</h5>
		</div> -->
		
	</header><!-- #masthead -->
