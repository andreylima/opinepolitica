
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
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53380412-1', 'auto');
  ga('send', 'pageview');

</script>
        <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ) ?>">
        <link rel="shortcut icon" href="<?php echo esc_url( get_stylesheet_directory_uri()); ?>/assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo esc_url( get_stylesheet_directory_uri()); ?>/assets/img/favicon.ico" type="image/x-icon">
	
    <?php wp_head(); ?>
</head>

<body  <?php body_class(); ?>>


<header>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
<img src="<?php echo get_stylesheet_directory_uri().'/assets/img/logo.png' ?>" alt="" id="logo">
</a>

<?php if (!is_user_logged_in()) 
{
	if (is_home()) 
	{ ?>
	<a href="#cadastro-wrapper-footer" class="cadastrar-link">CADASTRE-SE</a>

<?php } else{ ?>
	<a href="http://www.debategv.com.br" class="cadastrar-link">CADASTRE-SE</a>

	<?php } } ?>
		

<a href="#menu-body"><div class="open_menu">&#9776;</div></a>
 <?php 

if (is_home()) {
	if (is_user_logged_in()) { 

 	wp_nav_menu( array( 'theme_location'=>'logged_in', 'container_id' => 'menu-header' ) ); 
 	
 }
 else
 {
 	wp_nav_menu( array( 'theme_location'=>'logged_out', 'container_id' => 'menu-header' ) ); 
 	
 }
}
else
{
	if (is_user_logged_in()) { 

 	wp_nav_menu( array( 'theme_location'=>'logged_in', 'container_id' => 'menu-header' ) ); 
 	
 }
 else
 {
 	wp_nav_menu( array( 'theme_location'=>'interno', 'container_id' => 'menu-header' ) ); 
 	
 }
}
 
?>


<?php if (!is_user_logged_in()) {

      ?>

  		
		<div class="login-connect-header">
		
	<!-- 	<fb:login-button scope="public_profile,email" onlogin="checkLoginState();" class="face_button_header">
</fb:login-button> -->
 <?php do_action( 'wordpress_social_login' ); ?> 
			<form action="" method="post" id="log-form" novalidate="novalidate">
			 <input type="text" name="email_log" value="" id="email-log" placeholder="e-mail">
      		 <input type="password" name="senha_log" placeholder="senha" id="senha-log">
      		
      		
      		
      		<input type="submit" name="login" value="ENTRAR" id="btnentrar-log">
      		</form>
      		<div class="show-error"></div>
      		<!-- <span class="forgot-pass-header"><a href="">Esqueci a senha</a> </span>  -->
		</div>
		

<?php } else{ ?>
<div class="logged-menu">
<div class="avatar">
<?php echo get_avatar( $current_user->user_email , 60 ); ?>
</div>
<div class="user-logged">
	<?php echo $current_user->user_firstname ?>
	<span class="glyphicon glyphicon glyphicon-chevron-down open-user"></span>
	<div class="user-menu">
		<a href="<?php echo wp_logout_url(); ?>"><span class="log-out">Sair</span></a>
	</div>
</div>
</div>
<?php } ?>
 </header>
 <?php 

 	wp_nav_menu( array( 'theme_location'=>'mobile', 'container_id' => 'menu-body' ) ); 
 		

?>
