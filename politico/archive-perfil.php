<?php 

get_header();

global $post;

$perfis = new perfisModel($post->ID);

?>



<div id="archive-wrapper">

  <div class="title-panel text-center">
    <h3>Confira o nível de aprovação dos Poderes</h3> 
    <h4>Executivo e Legislativo</h4> 
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
      <h4 class="name-perfil"><?php the_title() ?></h4> 
      <div class="link-perfil"> PERFIL</div>
    </div>

  <?php endwhile; ?>





</div>





<?php get_footer() ?>