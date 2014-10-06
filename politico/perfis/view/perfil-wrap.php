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