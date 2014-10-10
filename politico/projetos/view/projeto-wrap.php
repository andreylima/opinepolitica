<div class="panel panel-default">
      <div class="panel-heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><span class="title-autor-panel">AUTOR:  
        <a href="<?php echo get_permalink( $autor_id); ?> ">
          <?php  echo get_the_post_thumbnail( $autor_id, "thumbnail",  array('class' =>'panel-autor')); ?></a></span></div>
      <div class="panel-body">
        <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
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
            <?php echo $projeto->getNegativar_percent(); ?>
          </div>
            </span>
          </a>
          <a href="<?php the_permalink(); ?>">
            <span class="mini-percent-apoiaram">
            <span class="glyphicon glyphicon-thumbs-up mini-icon-s"></span>
            <?php echo $projeto->getPositivar_percent(); ?>
            </span>
          </a>
		</div>
		</div>
		</div>

  </div>