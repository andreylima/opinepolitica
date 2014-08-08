<?php 

get_header();

global $post;

$perfis = new perfisModel($post->ID);

?>



<div id="archive-wrapper">

  <div class="title-panel text-center big-header">
    <h1>Confira o nível de aprovação dos Poderes</h1> 
    <h2>Executivo e Legislativo</h2> 
    <h1>de Governador Valadares</h1>
  </div>

  <div class="title-panel text-center small-header">
    <h3>Confira o nível de aprovação dos Poderes</h3> 
    <h4>Executivo e Legislativo</h4> 
    <h3>de Governador Valadares</h3>
  </div>

<?php get_search_form(); ?>

  <section class="perfis">


    <?php $loop = new WP_Query( array( 'post_type' => 'perfil' , 'cargos'=>'prefeito',  'posts_per_page' => 1) ); ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
      <?php 
      $perfis = new perfisModel($post->ID);
      $curtiu = $perfis->verifica_curtida();
      $naocurtiu = $perfis->verifica_naocurtida();

       ?>
      <div class="prefeito perfil">
      <div class="thumb-wrap">
        <div class="thumb">  
          <a href="<?php echo get_permalink($post->ID); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'img-circle perfil-size')); ?></a> 
          <a href=""><div class="votes pull-left curtir <?php echo ($curtiu) ? "votado" : ""; ?>" id="<?php echo $post->ID; ?>">
            <span class="glyphicon glyphicon-thumbs-up icon-vote">
              
            </span>
            <span class="percent-both percent-curtiu">
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
       <span class="percent-both percent-naocurtiu">
              <?php 
            
            echo $perfis->getNaocurtiu_percent(); 

            ?>
            </span>
        </div>
        </a>
      </div>
      </div>
      <h4 class="name-perfil"><?php the_title() ?></h4>
        <a href="<?php the_permalink(); ?>"><div class="link-perfil"> PERFIL</div></a>

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
    <div class="thumb-wrap">
      <div class="thumb">
        <a href="<?php echo get_permalink($post->ID); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'img-circle perfil-size')); ?></a> 
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
      </div>
      <a href="<?php the_permalink(); ?>"><h4 class="name-perfil"><?php the_title() ?></h4> </a>
      <a href="<?php the_permalink(); ?>"><div class="link-perfil"> PERFIL</div></a>
    </div>

  <?php endwhile; ?>





</div>

<!--   Janela Modal para login ou redirecionamento de registro. -->
    <div id="dialog" class="window">
    <a href="#" class="close">Fechar [X]</a>
  
    <div class="title-modal">Para opinar é necessário estar cadastrado.</div>
    <div class="inner_container">
      <div class="login_container">
            
              <form id="formLogin" class="form-vertical well"  action="" method="POST" novalidate="novalidate">
              <div class="control-group">
                <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>
              </div>
              <div class="control-group">
                
                <div class="controls">
                  <input type="text" class="input-large" id="email_log" name="email_log" placeholder="e-mail">
                </div>
               </div>
              <div class="control-group">
                <div class="controls">
                  <input type="password" class="input-large"  id="senha_log" name="senha_log" placeholder="senha">
                </div>
              </div>

              <div class="control-group">
                <button type="submit" class="btn-entrar">Entrar</button>
                <a href="" onclick="" class="lnk-recovery-password" data-toggle="modal">Esqueci
                  minha senha</a>
              </div>
              <div class="show-error-modal"> </div>
            </form>
          
          </div>

    <div class="register-container">
     
    
    <div class="form-vertical well">
         <div class="legend-registerfrm">Não possui cadastro?</div> 
         <div class="face-button-modal">             
            <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>
</div>
          <div id="register-manual-inside">Registrar Manualmente</div>



    </div>
      

    </div>
    </div>
    </div>

    <div id="mask"></div>



<?php get_footer() ?>