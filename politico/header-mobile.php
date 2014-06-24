
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
<div id="logo" ></div>
<?php if (!is_user_logged_in()) {

      ?>
<a href="#button-cadastrar" class="cadastrar-link">CADASTRE-SE</a>
<?php } ?>
<a href="#menu-body"><div class="open_menu">&#9776;</div></a>
<?php wp_nav_menu( array( 'theme_location'=>'principal', 'container_id' => 'menu-header' ) ); ?>

<?php if (!is_user_logged_in()) {

      ?>

  		
		<div class="login-connect-header">
		<div class="new-fb-btn new-fb-7 new-fb-default-anim"><div class="new-fb-7-1"><div class="new-fb-7-1-1">FACE</div></div></div>
			
			 <input type="text" name="email" value="" id="email-log" placeholder="e-mail">
      		 <input type="password" name="senha" placeholder="senha" id="senha-log">
      		
      		
      		
      		<input type="submit" name="login" value="ENTRAR" id="btnentrar-log">
      		
      		<!-- <span class="forgot-pass-header"><a href="">Esqueci a senha</a> </span>  -->
		</div>
		

<?php } ?>
 </header>
