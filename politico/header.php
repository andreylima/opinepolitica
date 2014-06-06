
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
	<!--[if lte IE 8]><script type="text/javascript" src="<?php bloginfo( 'template_url' ) ?>/assets/javascript/html5.js"></script><![endif]-->
	<!--<img class="img-circle" src="http://placehold.it/140x140"> -->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
  FB.init({
    appId      : '{532848680162864}',
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true  // parse XFBML
  });

  // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
  // for any authentication related change, such as login, logout or session refresh. This means that
  // whenever someone who was previously logged out tries to log in again, the correct case below 
  // will be handled. 
  FB.Event.subscribe('auth.authResponseChange', function(response) {
    // Here we specify what we do with the response anytime this event occurs. 
    if (response.status === 'connected') {
      // The response object is returned with a status field that lets the app know the current
      // login status of the person. In this case, we're handling the situation where they 
      // have logged in to the app.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // In this case, the person is logged into Facebook, but not into the app, so we call
      // FB.login() to prompt them to do so. 
      // In real-life usage, you wouldn't want to immediately prompt someone to login 
      // like this, for two reasons:
      // (1) JavaScript created popup windows are blocked by most browsers unless they 
      // result from direct interaction from people using the app (such as a mouse click)
      // (2) it is a bad experience to be continually prompted to login upon page load.
      FB.login();
    } else {
      // In this case, the person is not logged into Facebook, so we call the login() 
      // function to prompt them to do so. Note that at this stage there is no indication
      // of whether they are logged into the app. If they aren't then they'll see the Login
      // dialog right after they log in to Facebook. 
      // The same caveats as above apply to the FB.login() call here.
      FB.login();
    }
  });
  };

  // Load the SDK asynchronously
  (function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
  }(document));

  // Here we run a very simple test of the Graph API after login is successful. 
  // This testAPI() function is only called in those cases. 
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Good to see you, ' + response.name + '.');
    });
  }
</script>
		<div id="section-one">
		<header class="row-fluid">
		<img id="logo" class="img-circle logo-index pull-left" src="http://placehold.it/60x60">
		<?php
		wp_nav_menu( array( 'theme_location'=>'principal', 'container_id' => 'menu-bar' ) );
		?>
    <?php if (!is_user_logged_in()) {

      ?>
      <div class="login-form-header">
      <a href="http://localhost/politico/wp-login.php?loginFacebook=1&redirect=http://localhost/politico" onclick="window.location = 'http://localhost/politico/wp-login.php?loginFacebook=1&redirect='+window.location.href; return false;">
      <div class="new-fb-btn new-fb-3 new-fb-default-anim face-log"><div class="new-fb-3-1"><div class="new-fb-3-1-1">FACEBOOK</div></div></div>
      </a>
      <input type="text" name="email" value="email" id="email-log">
      <input type="text" name="senha" value="senha" id="senha-log">
      <input type="button" name="login" value="ENTRAR" id="btnentrar-log">
      <span class="forgot-pass-header"><a href="">Esqueci a senha</a> </span>   
    </div>
    <?php 
      }
      else
      {
        ?>
        <div class="logged-used">

      <div class="dropdown name-logged">
  <label for="dropdown-1" class="btn btn-dropdown"><?php echo $current_user->user_firstname." ".$current_user->user_lastname ?></label>
  <input class="dropdown-open" type="checkbox" id="dropdown-1" aria-hidden="true" hidden />
  <div class="dropdown-inner">
    <ul>
        <li>Minha conta</li>
        <li><a href="<?php echo wp_logout_url(); ?>" title="Sair">Sair</a></li>
    </ul>
  </div>
</div>
<img id="avatar" class="img-circle pull-right" src="http://placehold.it/60x60">
          
        </div>
        


        <?php
      }
    ?>
    
		<!--<div class="pull-right slogan" >
			<h4 class="text-right">Nossa liberdade não pode estar mais segura do que nas nossas próprias mãos.</h4>
			<h5 class="text-right">Thomas Jefferson</h5>
		</div> -->
		
	</header><!-- #masthead -->