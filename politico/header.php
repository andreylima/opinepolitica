
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
	<title>
		<?php wp_title(' ',true); ?>
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
	<link rel="image_src" href="<?php echo esc_url( get_stylesheet_directory_uri()); ?>/assets/img/logo.png" />

	<meta property="og:image" content="<?php echo esc_url( get_stylesheet_directory_uri()); ?>/assets/img/logo.png" />
	<meta property="og:title" content="DebateGV" />
	<meta property="og:description" content="Opine sobre os Projetos de Lei propostos em nossa cidade" />
	<?php wp_head(); ?>
</head>

<body  <?php body_class(); ?>>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&appId=520902698009161&version=v2.0";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

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


			<a href="#menu-body"><div class="open_menu"><i class="fa fa-bars"></i></div></a>
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

					<div class="Entrar-wrapper">
						<?php echo get_avatar("",40); ?>
						<span class="entrar-button">ENTRAR</span> 
					</div>
					<div class="login-buttons">

						<div class="face-login-header">
							<?php do_action( 'wordpress_social_login' ); ?>
							<a class="face-link" href="">
								<span class="login-social-header">Entrar com Facebook</span>
							</a>
						</div>

						<div class="login-with-email">
							<span class="flaticon-arrow195">Entrar com e-mail</span>
							
						</div>

					</div>



			<form action="" method="post" id="log-form" novalidate="novalidate">
			<span class="flaticon-left176"></span>
			 <input type="text" name="email_log" value="" id="email-log" placeholder="e-mail">
      		 <input type="password" name="senha_log" placeholder="senha" id="senha-log">
      		
      		
      		
      		<input type="submit" name="login" value="LOGIN" id="btnentrar-log">
      		</form>
      		<div class="show-error"></div>
      		
      	</div>


      	<?php } else{ ?>
      	<div class="logged-menu">
      		<a href="https://pt.gravatar.com/">
      			<div class="avatar">
      				<?php 
      				global $current_user;
      				get_currentuserinfo();
      				echo get_avatar( $current_user->user_email , 60 ); 

      				?>

      			</div>
      		</a>
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
