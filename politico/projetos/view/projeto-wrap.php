<div class="panel panel-default <?php echo ($is_mini)? 'mini-projeto  ' : ''; echo  $autor_id.' projeto-'.$situacao.' '.$sigla; ?>" >
      <div class="panel-heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><span class="title-autor-panel">AUTOR:  
        <a href="<?php echo get_permalink( $autor_id); ?> ">
          <?php  echo get_the_post_thumbnail( $autor_id, "thumbnail",  array('class' =>'panel-autor')); ?></a></span></div>
      <div class="panel-body">
        
        <a href="<?php the_permalink(); ?>">
        <div class="pic-projeto <?php echo $situacao; ?>" style="background-image: url('<?php echo $url ?>');">
        </div>
        </a>
      <div class="projeto-excerpt">
        <a href="<?php the_permalink(); ?>">
      	<?php the_excerpt(); ?>
      </a>
      	</div>
      	<div class="panel-bottom">
        <a href="<?php the_permalink(); ?>">
      	<div class="see-more">
      		SAIBA MAIS
      	</div>
        </a>
      	<div class="percent-wrapper">
          <a href="<?php the_permalink(); ?>">
      	<span class="mini-percent-naoapoiaram">
          <div>
            <span class="glyphicon glyphicon-thumbs-down mini-icon-n"></span>
            <?php echo $projetos->getNegativar_percent(); ?>
          </div>
            </span>
          </a>
          <a href="<?php the_permalink(); ?>">
            <span class="mini-percent-apoiaram">
            <span class="glyphicon glyphicon-thumbs-up mini-icon-s"></span>
            <?php echo $projetos->getPositivar_percent(); ?>
            </span>
          </a>
		</div>
		</div>
  <?php if ($show_comments): ?>

  <div class="first-comments"> 
    <span>Total de comentários: <?php echo get_comments_number( $post->ID ); ?> </span>  
    <div class="comments">
      <ol class='commentlist'>
        <?php
 
          //Display the list of comments
        wp_list_comments(array(
            'per_page' => 3, //Allow comment pagination
            'reverse_top_level' => false //Show the latest comments at the top of the list
            ), $comments);
            ?>
          </ol>

        </div>
      </div>
      
    <?php endif ?>

		</div>

  </div>