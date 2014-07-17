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
  <?php if (!is_user_logged_in()) { ?>
<div class="wrap-destaque wide-destaque ">
  <?php }else { ?>
<div class="wrap-destaque-full wide-destaque">
  <?php } ?>
	<h1 class="fundo">PARTICIPE E AJUDE </h1>
  <h1 class="fundo">A FISCALIZAR A CIDADE</h1>  
	<h1 class="fundo">QUE A GENTE AMA.</h1>
</div>
<div class="wrap-destaque mobile-destaque">
  <h1 class="fundo">OPINE SOBRE OS PROJETOS DE LEI</h1>
  <h1 class="fundo">PROPOSTOS EM GOVERNADOR VALADARES </h1>  
</div>


<a href="#projetos" class="placas">
<div class="placa-projetos">
  <h4>DISCUTA OS</h4>
  <h4>PROJETOS DE LEI</h4>
  <h4>PROPOSTOS EM</h4>
  <h4>SUA CIDADE.</h4>
</div>
<span id="scroll-down-proj"></span>
</a>

<a href="#politicos" class="placas">
<?php if (!is_user_logged_in()) { ?>
<div class="placa-politicos">
<?php }else { ?>
<div class="placa-politicos-full">
<?php } ?>
  <h4>CONFIRA O NÍVEL DE APROVAÇÃO </h4> 
  <h4>E ESCOLHA</h4>
  <h4>QUEM TE REPRESENTA.</h4>
</div>
<?php if (!is_user_logged_in()) { ?>
<span id="scroll-down-pol"></span>
<?php }else { ?>
<span id="scroll-down-pol-full"></span>
<?php } ?>
</a>




<?php if (!is_user_logged_in()) { ?>
  <div class="form-cadastro-top">

  
  <h1>CADASTRE-SE PARA INTERAGIR.</h1>
  <h3>É rápido e fácil.</h3>
  <form action="" method="post" id="cadastro_form" novalidate="novalidate">
  <input type="text" placeholder="Nome" id="nome" class="cadastro-input" name="nome">
  <input type="text" placeholder="Sobrenome" id="sobrenome" class="cadastro-input" name="sobrenome">
  <input type="text" placeholder="Qual é o seu e-mail?" id="email" class="cadastro-input" name="email">
  <input type="text" placeholder="Digite seu CPF." id="CPF" class="cadastro-input" name="cpf">
  <span class="legenda-cpf">*É importante para termos certeza que você é uma pessoa real.</span>
  <select class="cidade_select" id="cidade_select" name="cidade_select">
  <option value="" disabled selected>Selecione a sua Cidade</option>
  <option value="Governador Valadares">Governador Valadares</option>
  </select>
  <input type="password" placeholder="Escolha uma senha." id="senha" class="cadastro-input" name="senha">
  <input type="submit" name="cadastrar" value="Criar conta" id="button-cadastrar">
</div>
</form>
</div>
<?php } ?>

</div>
<?php if (!is_user_logged_in()) {

      ?>
<div class="login-wrap">

  <div class="login-title"> FAÇA LOGIN</div>
	<div class="login-field">
		
		<span class="login-connect">
			<div class="inputs-login">
			 <span class="icon-input"><i class="fa fa-envelope fa-2x"></i></span><input type="text" name="email" value="" id="email-log" placeholder="e-mail">
      		<span class="icon-input"><i class="fa fa-key fa-2x"></i></span><input type="password" name="senha" placeholder="senha" id="senha-log">
      		</div>
      		<div class="center-buttons">
      		<div class="new-fb-btn new-fb-7 new-fb-default-anim"><div class="new-fb-7-1"><div class="new-fb-7-1-1">FACE</div></div></div>
      		<input type="submit" name="login" value="ENTRAR" id="btnentrar-log">
      		</div>
      		<!-- <span class="forgot-pass-header"><a href="">Esqueci a senha</a> </span>  -->
		</span>
	</div>
</div>
<?php } ?>

<div class="projetos-slider-wrapper" id="projetos">
<div class="projetos-title">PROJETOS DE LEI RECENTES</div>
<div class="projetos-slider" data-block-text="false">
		
		<ul>
			
									
	<?php $loop = new WP_Query( array( 'post_type' => 'projeto' , 'posts_per_page' => 5, 'orderby'=> 'modified') ); ?>
  <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
  <?php 
      $projeto = new projetosModel(get_the_ID());
      $autor_id = $projeto->getAutor_projeto();
      $positivou = $projeto->verifica_positivou();
      $negativou = $projeto->verifica_negativou();

  ?>
    <li class="mini-projeto-index">
     <div class="panel panel-default">
      <div class="panel-heading"><?php the_title(); ?><span class="title-autor-panel">AUTOR:  <a href="<?php echo get_permalink( $autor_id); ?> "><?php  echo get_the_post_thumbnail( $autor_id, "thumbnail",  array('class' =>'panel-autor')); ?></a></span></div>
      <div class="panel-body">
        <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
        <div class="pic-projeto" style="background-image: url('<?php echo $url ?>');">

        </div>
      <div class="projeto-excerpt">
      	<?php the_excerpt(); ?>
      	</div>
      	<div class="panel-bottom">
        <a href="<?php the_permalink(); ?>">
      	<div class="see-more">
      		SAIBA MAIS
      	</div>
        </a>
      	<div class="percent-wrapper">
      	<span class="mini-percent-naoapoiaram">
          <div>
            <span class="glyphicon glyphicon-thumbs-down mini-icon-n"></span>
            <?php echo $projeto->getNegativar_percent(); ?>
          </div>
            </span>
          
            <span class="mini-percent-apoiaram">
            <span class="glyphicon glyphicon-thumbs-up mini-icon-s"></span>
            <?php echo $projeto->getPositivar_percent(); ?>
            </span>
		</div>
		</div>
		</div>

      	</div>

    </li>

  <?php endwhile; ?>
			
		</ul>
		
	</div>
	



</div>

<div class="prefeito-wrapper" id="politicos">
	
<a href="#vereadores-slider-wrapper" id="vereador-scroll-block"><span class="vereador-scroll">VEREADORES</span><span id="scroll-down-vereadores"></span></a>
    <?php $loop = new WP_Query( array( 'post_type' => 'perfil' , 'cargos'=>'prefeito',  'posts_per_page' => 1) ); ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
      <?php 
      $perfis = new perfisModel($post->ID);
      $curtiu = $perfis->verifica_curtida();
      $naocurtiu = $perfis->verifica_naocurtida();

       ?>
      <div class="prefeito perfil">
        <div class="cargo"><?php $terms = wp_get_post_terms( $post->ID, "Cargos", array("fields" => "names") ); echo $terms[0];  ?></div>
        <div class="thumb-wrap">
        <div class="thumb">  
          <a href="<?php echo get_permalink($post->ID); ?>"><?php the_post_thumbnail('custom', array('class' => 'img-circle perfil-size')); ?></a> 
          <div class="votes pull-left curtir <?php echo ($curtiu) ? "votado" : ""; ?>" id="<?php echo $post->ID; ?>">
            <span class="glyphicon glyphicon-thumbs-up icon-vote">
              
            </span>
            <span class="percent-both percent-curtiu">
            <?php 
            
            echo $perfis->getCurtiu_percent(); 

            ?>
            </span>
          </div>
        
        
        <div class="voten pull-right naocurtir <?php echo ($naocurtiu) ? "votado" : ""; ?>" id="<?php echo $post->ID; ?>">
        <span class="glyphicon glyphicon-thumbs-down icon-vote">
          
        </span>
       <span class="percent-both percent-naocurtiu">
              <?php 
            
            echo $perfis->getNaocurtiu_percent(); 

            ?>
            </span>
        </div>
        
      </div>
      </div>  <!-- thumb wrap -->

      <h1 class="name-perfil"><?php the_title() ?></h1>
        <a href="<?php the_permalink(); ?>"><div class="link-perfil">VER PERFIL</div></a>

    </div>

  <?php endwhile; ?>
</div> <!-- prefeito wrapper -->

<div id="vereadores-slider-wrapper">
    <div class="vereadores-slider">

      <ul>

          
            <?php $loop = new WP_Query( array( 'post_type' => 'perfil' , 'cargos'=>'Vereador',  'posts_per_page' => 100, 'orderby'=> 'title', 'order' => 'asc') ); ?>
  <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
  <?php 
      $perfis = new perfisModel($post->ID);
      $curtiu = $perfis->verifica_curtida();
      $naocurtiu = $perfis->verifica_naocurtida();

  ?>
    <li>

    <div class="vereador perfil  <?php echo $post->ID ?>">
      <div class="cargo"><?php $terms = wp_get_post_terms( $post->ID, "Cargos", array("fields" => "names") ); echo $terms[0];  ?></div>
      <div class="thumb-wrap">
      <div class="thumb">
        <a href="<?php echo get_permalink($post->ID); ?>"><?php the_post_thumbnail('custom', array('class' => 'img-circle perfil-size')); ?></a> 
        <a href="">
        <div class="votes pull-left curtir <?php echo ($curtiu) ? "votado" : ""; ?>" id="<?php echo $post->ID; ?>">
        <span class="glyphicon glyphicon-thumbs-up icon-vote">
          
        </span>
        <span class="percent-both percent-curtiu">
              <?php 
            $perfis = new perfisModel($post->ID);
            echo $perfis->getCurtiu_percent(); 

            ?>
            </span>
        </div>
        </a>
        <a href=""> 
        <div class="voten pull-right naocurtir <?php echo ($naocurtiu) ? "votado" : ""; ?>" id="<?php echo $post->ID; ?>">
        <span class="glyphicon glyphicon-thumbs-down icon-vote">
          
        </span>
        <span class="percent-both percent-naocurtiu">
               <?php 
            $perfis = new perfisModel($post->ID);
            echo $perfis->getNaocurtiu_percent(); 

            ?>
            </span>
        </div>
        </a>
      </div>
      </div> <!-- thumb-wrap -->
      <h1 class="name-perfil"><?php the_title() ?></h1>
        <a href="<?php the_permalink(); ?>" ><div class="link-perfil">VER PERFIL</div></a>
    </div>
 </li>
  <?php endwhile; ?>

         

      </ul>

    </div>


</div> <!-- vereadores wrapper -->
<?php if (!is_user_logged_in()) {

      ?>
<div class="login-wrapper-footer">
  
<div class="form-cadastro">
  <h1>CADASTRE-SE PARA INTERAGIR.</h1>
  <h3>É rápido e fácil.</h3>
  <form action="" method="post" id="cadastro_form_down" novalidate="novalidate">
  <input type="text" placeholder="Nome" id="nome" class="cadastro-input" name="nome">
  <input type="text" placeholder="Sobrenome" id="sobrenome" class="cadastro-input" name="sobrenome">
  <input type="text" placeholder="Qual é o seu e-mail?" id="email" class="cadastro-input" name="email">
  <input type="text" placeholder="Digite seu CPF." id="CPF" class="cadastro-input" name="cpf">
  <span class="legenda-cpf">*É importante para termos certeza que você é uma pessoa real.</span>
  <select class="cidade_select" id="cidade_select" name="cidade_select">
  <option value="" disabled selected>Selecione a sua Cidade</option>
  <option value="Governador Valadares">Governador Valadares</option>
  </select>
  <input type="password" placeholder="Escolha uma senha." id="senha" class="cadastro-input" name="senha">
  <input type="submit" name="cadastrar" value="Criar conta" id="button-cadastrar">
</div>
</form>
</div>
<?php } ?>


<div id="dialog" class="window">
    <a href="#" class="close">Fechar [X]</a>
  
    <div class="title-modal">Para opinar é necessário estar cadastrado.</div>
    <div class="inner_container">
      <div class="login_container">
            
              <form id="formLogin" class="form-vertical well" target="_self" action="" method="POST">
              <div class="control-group">
                <div class="new-fb-btn new-fb-7 new-fb-default-anim"><div class="new-fb-7-1"><div class="new-fb-7-1-1">ENTRAR</div></div></div>
              </div>
              <div class="control-group">
                
                <div class="controls">
                  <input type="text" class="input-large" id="username_login" placeholder="e-mail">
                </div>
               </div>
              <div class="control-group">
                <div class="controls">
                  <input type="password" class="input-large"  id="password_login" placeholder="senha">
                </div>
              </div>

              <div class="control-group">
                <button type="submit" class="btn btn-primary btn-pos">Entrar</button>
                <a href="" onclick="" class="lnk-recovery-password" data-toggle="modal">Esqueci
                  minha senha</a>
              </div>
            </form>
          
          </div>

    <div class="register-container">
      <div class="legend-registerfrm">Não possui cadastro?</div>
    
    <div class="form-vertical well">
                      
          <div class="new-fb-btn new-fb-1 new-fb-default-anim"><div class="new-fb-1-1"><div class="new-fb-1-1-1">Registrar com Facebook</div></div></div>
          <div id="register-manual">Registrar Manualmente</div>



    </div>
      

    </div>
    </div>
    </div>

    <div id="mask"></div>



<?php get_footer() ?>

