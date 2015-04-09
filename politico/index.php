<?php 

get_header(); 


?>
<script>
  jQuery(function() {
    jQuery('a[href*=#]:not([href=#])').click(function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = jQuery(this.hash);
        target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
        if (target.length) {
          jQuery('html,body').animate({
            scrollTop: target.offset().top
          }, 1000);
          return false;
        }
      }
    });
  });

  
</script>

<div id="destaque">




<div class="wrap-destaque wide-destaque ">
  
  <img src="<?php echo get_stylesheet_directory_uri().'/assets/img/logo.png' ?>" alt="" id="logo-home">
<div class="letreiro">
  <h2 class="fundo">PARTICIPE!</h2>
	<h2 class="fundo">AJUDE A FISCALIZAR</h2>
  <h2 class="fundo"> A CIDADE QUE A GENTE AMA.</h2>  
	</div>
</div>

<div class="wrap-destaque mobile-destaque">
   <h2>PARTICIPE,</h2>
  <h2>AJUDE A FISCALIZAR</h2>
  <h2> A CIDADE QUE A GENTE AMA.</h2>  
  
</div>





<a href="#projetos" class="placas">
<div class="placa-projetos">
  <span>ÚLTIMOS PROJETOS DE LEI</span>
  <div class="icon-projetos-container">
<span class="flaticon-signature2"></span>
</div>
</div>
<span id="scroll-down-proj"></span>
</a>

<a href="<?php echo esc_url( get_permalink( get_page_by_title( 'boca no trombone' ) ));  ?>" class="placas">
<div class="placa-trombone">
  <span class="boca-label">BOCA NO TROMBONE</span>
    <div class="icon-trombone-container">
<span class="flaticon-loudspeaker17"></span>
</div>
<span class="boca-label2">FAÇA A SUA RECLAMAÇÃO!</span>
<span class="boca-label3">VEJA TAMBÉM O MAPA DE RECLAMAÇÕES.</span>
</div>
</a>

<a href="#politicos" class="placas">
<?php if (!is_user_logged_in()) { ?>
<div class="placa-politicos">
<?php }else { ?>
<div class="placa-politicos-full">
<?php } ?>
  <span>AVALIE UM POLÍTICO</span>
  <div class="icon-avalie-container">
  <span class="flaticon-thumb35 icon-avalie-up"></span>
    </div>
 </div>
<?php if (!is_user_logged_in()) { ?>
<span id="scroll-down-pol"></span>
<?php }else { ?>
<span id="scroll-down-pol-full"></span>
<?php } ?>
</a>




<?php if (!is_user_logged_in()) { ?>
  <div class="form-cadastro-top" >

  
  <h1>CADASTRE-SE COM APENAS DOIS CLIQUES.</h1>
  <h4>Não teremos acesso a sua senha do Facebook.</h4>
<div class="face-login-header">
              <?php do_action( 'wordpress_social_login' ); ?>
              
                <span class="login-social-header">Cadastrar com Facebook</span>
              
            </div>
<div class="register-with-email">
              <span class="flaticon-create1">Cadastrar com e-mail</span>
              
            </div>

  <form action="" method="post" id="cadastro_form" novalidate="novalidate">
  <input type="text" placeholder="Nome" id="nome" class="cadastro-input" name="nome">
  <input type="text" placeholder="Sobrenome" id="sobrenome" class="cadastro-input" name="sobrenome">
  <input type="text" placeholder="Qual é o seu e-mail?" id="email" class="cadastro-input email_validate email-input" name="email">
  <span class="sexo">Sexo:</span>
  <input type="radio" name="sex" value="male" required>M
  <input type="radio" name="sex" value="female">F
  <input type="password" placeholder="Escolha uma senha." id="senha" class="cadastro-input" name="senha">
  <input type="checkbox" name="termos" value="aceito" class="check_aceito"> Li e estou de acordo com os <a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Termos' ) ) ); ?>" TARGET="_blank">Termos de uso do site.</a>
  <input type="submit" name="cadastrar" value="Criar conta" id="button-cadastrar">
</form>
</div>
<?php } ?>

</div>
<?php if (!is_user_logged_in()) {

      ?>
<div class="login-wrap">

  <div class="login-title"> FAÇA LOGIN</div>
  <div class="face-login-header">
              <?php do_action( 'wordpress_social_login' ); ?>
              
                <span class="login-social-header">Entrar com Facebook</span>
              
            </div>
            <span class="entrar-manual"> Entrar com e-mail:</span>
	<div class="login-field">
		
		<div class="login-connect">
			<div class="inputs-login">
      <form action="" method="post" id="log-form-mobile" novalidate="novalidate">
			 <span class="icon-input"><i class="fa fa-envelope fa-2x"></i></span><input type="text" name="email_log" value="" id="email_log" placeholder="e-mail">
      		<span class="icon-input"><i class="fa fa-key fa-2x"></i></span><input type="password" name="senha_log" placeholder="senha" id="senha_log">
      		</div>
      		<div class="center-buttons">
          
      
      		<input type="submit" name="login" value="ENTRAR" id="btnentrar-log">
      		</div>
          </form>
      		<!-- <span class="forgot-pass-header"><a href="">Esqueci a senha</a> </span>  -->
		</div>
	</div>
</div>
<div class="show-error"> </div>
<?php } ?>

<div class="projetos-slider-wrapper" id="projetos">
<div class="projetos-title">PROJETOS DE LEI RECENTES</div>
<div class="projetos-slider" data-block-text="false">
		
		<ul>
			
									
	<?php $loop = new WP_Query( array( 'post_type' => 'projeto' , 'posts_per_page' => 5, 'orderby'=> 'modified') ); ?>
  <?php while ( $loop->have_posts() ) : $loop->the_post(); 
  
      $projetos = new projetosModel($post->ID);
      $autor_id = $projetos->getAutor_projeto();
      $situacao = get_post_meta( $post->ID, 'situacao',true);
      $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
      $sigla = $projetos->get_partido();

  ?>
    <li class="mini-projeto-index">

     <?php include(locate_template('projetos/view/projeto-wrap.php')); ?> <!-- carrega o template parte do projeto -->

    </li>

  <?php endwhile; ?>
			
		</ul>
		
	</div>
	



</div>

<div class="prefeito-wrapper" id="politicos">
	
<a href="#vereadores-slider-wrapper" id="vereador-scroll-block"><span class="vereador-scroll">VEREADORES</span><span id="scroll-down-vereadores"></span></a>
    <?php $loop = new WP_Query( array( 'post_type' => 'perfil' , 'cargos'=>'executivo',  'posts_per_page' => 1) );
    $thumbnail_size = 'custom'; //300 x 300

    while ( $loop->have_posts() ) : $loop->the_post(); ?>
      <?php 
      $perfis = new perfisController($post->ID);
      $curtiu = $perfis->verifica_curtida();
      $naocurtiu = $perfis->verifica_naocurtida();
      $projetos_debatidos = $perfis->get_projetos_debatidos();

       ?>
      <div class="prefeito perfil">
        <div class="cargo"><?php $terms = wp_get_post_terms( $post->ID, "Cargos", array("fields" => "names") ); echo $terms[0];  ?></div>
         <?php include(locate_template('perfis/view/perfil-wrap.php')); ?> <!-- carrega o template parte do perfil do político -->

    </div>

  <?php endwhile; ?>
</div> <!-- prefeito wrapper -->

<div id="vereadores-slider-wrapper">
    <div class="vereadores-slider">

      <ul>

          
            <?php $loop = new WP_Query( array( 'post_type' => 'perfil' , 'cargos'=>'Vereador',  'posts_per_page' => 100, 'orderby'=> 'title', 'order' => 'asc') ); ?>
  <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
  <?php 
      $perfis = new perfisController($post->ID);
      $curtiu = $perfis->verifica_curtida();
      $naocurtiu = $perfis->verifica_naocurtida();
      $projetos_debatidos = $perfis->get_projetos_debatidos();
  ?>
    <li>

    <div class="vereador perfil  <?php echo $post->ID ?>">
      <div class="cargo"><?php $terms = wp_get_post_terms( $post->ID, "Cargos", array("fields" => "names") ); echo $terms[0];  ?></div>

       <?php include(locate_template('perfis/view/perfil-wrap.php')); ?> <!-- carrega o template parte do perfil do político -->
 </li>
  <?php endwhile; ?>

         

      </ul>

    </div>


</div> <!-- vereadores wrapper -->
<div class="social-wrapper">
  <span class="social-title">A UNIÃO FAZ A FORÇA!</span>
<div class="fb-like-box" data-href="https://www.facebook.com/debategv" data-width="1000" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
</div>
<?php if (!is_user_logged_in()) {

      ?>
<div id="cadastro-wrapper-footer">
  
<div class="form-cadastro" >
  <h1>CADASTRE-SE COM APENAS DOIS CLIQUES.</h1>
  <h4>Não teremos acesso a sua senha do Facebook.</h4>
<div class="face-login-header">
              <?php do_action( 'wordpress_social_login' ); ?>
              
                <span class="login-social-header">Cadastrar com Facebook</span>
              
            </div><span class="cadastro-manual">Cadastro manual:</span>
  <form action="" method="post" id="cadastro_form_mobile" novalidate="novalidate">
  <input type="text" placeholder="Nome" id="nome_mobile" class="cadastro-input" name="nome">
  <input type="text" placeholder="Sobrenome" id="sobrenome_mobile" class="cadastro-input" name="sobrenome">
  <input type="text" placeholder="Qual é o seu e-mail?" id="email_mobile" class="cadastro-input email_validate email-input" name="email">
    <span class="sexo">Sexo:</span>
  <input type="radio" name="sex" value="male" required>M
  <input type="radio" name="sex" value="female">F
  <input type="password" placeholder="Escolha uma senha." id="senha_mobile" class="cadastro-input" name="senha">
  <input type="checkbox" name="termos" value="aceito" class="check_aceito"> Li e estou de acordo com os <a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Termos' ) ) ); ?>" TARGET="_blank">Termos de uso do site.</a>
  <input type="submit" name="cadastrar" value="Criar conta" id="button-cadastrar">
</form>
</div>
</div>
<?php } ?>


<?php include(locate_template('modal-template.php')); ?> <!-- carrega o template parte do modal -->

<!-- modal termos -->
<div id="modal-termos">
<div class="panel panel-default termos-size">
  <div class="panel-heading">
  <span class="close">Fechar [x]</span>
    <span class="termos-header-modal">Termos de Serviço e Sigilo do DebateGV</span>
    
  </div>
  <div class="panel-body">
   <div id="content" class="widecolumn">
 <?php 

$page = get_posts(
    array(
        'name'      => 'termos',
        'post_type' => 'page'
    )
);

 echo $page[0]->post_content
 ?>

 </div>
  </div>
</div>
</div>



<?php get_footer() ?>

