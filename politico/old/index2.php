<?php 

get_header();

global $post;

$perfis = new perfisModel($post->ID);

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
<div class="destaque">
  <h1 class="fundo">Opine sobre os Projetos de Lei</h1> 
  <h1 class="fundo">propostos pelos políticos</h1>
  <h1 class="fundo">de Governador Valadares</h1>
</div>
<?php if (!is_user_logged_in()) {

      ?>
<div class="form-cadastro">
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

<?php } ?>

<a id="scroll_down" href="#section-two"></a>

</div> <!-- section one -->

<div id="section-two">

  <div class="title-panel text-center">
    <h3>Confira o nível de aprovação dos Poderes</h3> 
    <h1>Executivo e Legislativo</h1> 
    <h3>de Governador Valadares</h3>
  </div>

  <section class="perfis">


    <?php $loop = new WP_Query( array( 'post_type' => 'perfil' , 'cargos'=>'prefeito',  'posts_per_page' => 1) ); ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
      <?php 
      $perfis = new perfisModel($post->ID);
      $curtiu = $perfis->verifica_curtida();
      $naocurtiu = $perfis->verifica_naocurtida();

       ?>
      <div class="prefeito perfil">
        <div class="thumb">  
          <a href="<?php echo get_permalink($post->ID); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'img-circle perfil-size')); ?></a> 
          <a href=""><div class="votes pull-left curtir <?php echo ($curtiu) ? "votado" : ""; ?>" id="<?php echo $post->ID; ?>">
            <span class="glyphicon glyphicon-thumbs-up icon-vote">
              
            </span>
            <span class="percent-autor">
            <?php 
            
            echo $perfis->getCurtiu_percent(); 

            ?>
            </span>
          </div>
        </a>
        <a href="">
        <div class="voten pull-right naocurtir <?php echo ($naocurtiu) ? "votado" : ""; ?>" id="<?php echo $post->ID; ?>">
        <span class="glyphicon glyphicon-thumbs-down icon-vote">
          
        </span>
       <span class="percent-autor">
              <?php 
            
            echo $perfis->getNaocurtiu_percent(); 

            ?>
            </span>
        </div>
        </a>
      </div>
      
      <h4 class="name_perfil"><?php the_title() ?></h4>
        <div class="link-perfil"> PERFIL</div>

    </div>

  <?php endwhile; ?>



  <?php $loop = new WP_Query( array( 'post_type' => 'perfil' , 'cargos'=>'Vereador',  'posts_per_page' => 100, 'orderby'=> 'title', 'order' => 'asc') ); ?>
  <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
  <?php 
      $perfis = new perfisModel($post->ID);
      $curtiu = $perfis->verifica_curtida();
      $naocurtiu = $perfis->verifica_naocurtida();

  ?>
    <div class="vereador perfil">
      <div class="thumb">
        <a href="<?php echo get_permalink($post->ID); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'img-circle perfil-size')); ?></a> 
        <a href="">
        <div class="votes pull-left curtir <?php echo ($curtiu) ? "votado" : ""; ?>" id="<?php echo $post->ID; ?>">
        <span class="glyphicon glyphicon-thumbs-up icon-vote">
          
        </span>
        <span class="percent-autor">
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
        <span class="percent-autor">
               <?php 
            $perfis = new perfisModel($post->ID);
            echo $perfis->getNaocurtiu_percent(); 

            ?>
            </span>
        </div>
        </a>
      </div>
      <h4 class="name_perfil"><?php the_title() ?></h4> 
      <div class="link-perfil"> PERFIL</div>
    </div>

  <?php endwhile; ?>




</section>

</div>

<!--   Janela Modal para login ou redirecionamento de registro. -->
    <div id="dialog" class="window">
    <a href="#" class="close">Fechar [X]</a>
  
    <div class="title-modal">Para opinar é necessário estar cadastrado.</div>
    <div class="inner_container">
      <div class="login_container">
            <div class="legend-frmlogin">Entrar</div>
              <form id="formLogin" class="form-vertical well" target="_self" action="" method="POST">
              <div class="control-group">
                <div class="new-fb-btn new-fb-7 new-fb-default-anim"><div class="new-fb-7-1"><div class="new-fb-7-1-1">ENTRAR</div></div></div>
              </div>
              <div class="control-group">
                <label class="control-label" for="username_login">E-mail</label>
                <div class="controls">
                  <input type="text" class="input-large" id="username_login">
                </div>
                </br>
              </div>
              <div class="control-group">
                <label class="control-label" for="username_pass">Senha</label>
                <div class="controls">
                  <input type="password" class="input-large"  id="password_login">
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
      
          <div class="chamada">É rápido, e fácil. Basta escolher uma das opções abaixo.</div>
          
          <div class="new-fb-btn new-fb-1 new-fb-default-anim"><div class="new-fb-1-1"><div class="new-fb-1-1-1">Registrar com Facebook</div></div></div>
           <div class="register-manual">Registrar Manualmente</div>



    </div>
      

    </div>



    </div>

    </div>
    <div id="mask"></div>
<?php get_footer() ?>

