<?php 

get_header(); 

?>




<div id="single-post-wrapper">
<div class="post-wrapper">




	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>" class="post">
				
			<?php
while ( have_posts() ) : the_post(); ?>
	<h1 class="title-post">
	<?php the_title(); ?>
	</h1>
	<?php the_post_thumbnail( 'medium', array( 'class' => 'post-thumb' ) ); ?>
	<div class="post-body">
	<?php the_content(); ?>
	</div>
	<?php comments_template(); ?>
  
<?php endwhile; ?>

		</div>
	</div>


	<div class="navigation">
		<div class="next-posts"><?php next_posts_link(); ?></div>
		<div class="prev-posts"><?php previous_posts_link(); ?></div>
	</div>



<?php get_sidebar(); ?>



</div>















<?php 

get_footer('blog'); 

?>
