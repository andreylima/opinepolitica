
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
<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      conectado();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    
        FB.getLoginStatus(function(response) {
    	statusChangeCallback(response);
  });
    
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '520902698009161',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.0' // use version 2.0
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.



  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function conectado() {
    
    FB.api('/me', function(response) {
    	var first_name = response.first_name;
    	var last_name = response.last_name;
    	var email = response.email;
    	var gender = response.gender;

    	
    		// var dados = [first_name, last_name, email,gender ];
    		var user_data = 'first_name='+first_name+'&last_name='+last_name+'&email='+email+'&gender='+gender;


    		jQuery.ajax({
    			type: 'POST',
    			url: myAjax.ajaxurl,
    			data: user_data+ '&action=cadastro_faceuser'+'&security='+myAjax.ajax_nonce,
    			success: function(response) {

    				console.log(response);
    				location.reload(true);

    				event.preventDefault();
    			}
    		});
    	
      
    });
  }
</script>
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
		<div class="face_button_header">
		<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>
</div>
			<form action="" method="post" id="log-form" novalidate="novalidate">
			 <input type="text" name="email_log" value="" id="email-log" placeholder="e-mail">
      		 <input type="password" name="senha_log" placeholder="senha" id="senha-log">
      		
      		
      		
      		<input type="submit" name="login" value="ENTRAR" id="btnentrar-log">
      		</form>
      		<div class="show-error"></div>
      		<!-- <span class="forgot-pass-header"><a href="">Esqueci a senha</a> </span>  -->
		</div>
		

<?php } else{ ?>
<div class="user-logged">
	<?php echo $current_user->user_firstname ?>
	<span class="glyphicon glyphicon glyphicon-chevron-down open-user"></span>
	<div class="user-menu">
		<a href="<?php echo wp_logout_url(); ?>"><span class="log-out">Sair</span></a>
	</div>
</div>
<?php } ?>
 </header>
 <?php 

 	wp_nav_menu( array( 'theme_location'=>'logged_in', 'container_id' => 'menu-body' ) ); 
 		

?>
