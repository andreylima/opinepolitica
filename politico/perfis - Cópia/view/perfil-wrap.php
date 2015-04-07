<div class="thumb-wrap">
      <div class="thumb">
        <a href="<?php echo get_permalink($post->ID); ?>"><?php the_post_thumbnail($thumbnail_size, array('class' => 'img-circle perfil-size')); ?></a> 
        
        <div class="votes pull-left curtir <?php echo ($curtiu) ? "votado" : ""; ?>" id="<?php echo $post->ID; ?>">
        <span class="glyphicon glyphicon-thumbs-up icon-vote">
          
        </span>
        <span class="percent-both percent-curtiu">
              <?php 
            $perfis = new perfisController($post->ID);
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
      </div>

      <a href="<?php the_permalink(); ?>">
        <h2 class="name-perfil">
        <?php the_title() ?>
        </h2> 
      </a>

      <div class="projetos-cadastrados">
        Projetos cadastrados: <?php echo $projetos_debatidos; ?>
      </div>

      <a href="<?php the_permalink(); ?>">
        <div class="link-perfil">
          PERFIL
        </div>
      </a>