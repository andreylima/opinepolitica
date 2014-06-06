
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
	<title>
	<?php
	/*
	 * Mesmo código utilizado no tema padrão do WordPress, para escrever a tag <title> do site.
	 */
	global $page, $paged;
  global $current_user;
  get_currentuserinfo();

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
	
    <?php wp_head(); ?>
</head>
<body  <?php body_class(); ?>>
<header>
<img id="logo" class="img-circle logo-index pull-left" src="http://placehold.it/60x60">
<div class="open_menu">&#9776;</div>
<?php wp_nav_menu( array( 'theme_location'=>'principal', 'container_id' => 'menu-header' ) ); ?>

 </header>
