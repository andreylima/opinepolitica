<?php 

get_header(); 
  global $paged;
  global $wp_query;
  $temp = $wp_query; 
  $wp_query = null; 
  $wp_query = new WP_Query(); 
  $wp_query->query('posts_per_page=7&post_type=post'.'&paged='.$paged);
?>
<div id="page-wrapper">

<div class="post-wrapper">

<?php 
// $the_query = new WP_Query( array('post_type' => 'post','orderby'=> 'date', 'order' => 'desc','posts_per_page' => 7,'paged' => $paged) );
if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

	<div <?php post_class('post-mini'); ?> id="post-<?php the_ID(); ?>" >
	<div class="thumb-wrapper-blog">
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail', array( 'class' => 'post-thumb' ) ); ?></a>
	</div>
		<div class="body-post">
		<h1 class="title-post"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<div class="resumo">
		<a href="<?php the_permalink(); ?>">
			<?php the_excerpt(); ?>
			<span class="leia-mais">...Leia mais</span>
			</a>
		</div>
		</div>
	</div>

<?php endwhile;  ?>

	<div class="navigation">
		<div class="next-posts"><?php next_posts_link('Mais Posts'); ?></div>
		<div class="prev-posts"><?php previous_posts_link('Posts Recentes'); ?></div>
	</div>

<?php else : ?>

	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<h1>Not Found</h1>
	</div>

<?php endif; 

wp_reset_postdata();

?>
</div>
<div class="sidebar-wrapper"><?php get_sidebar(); ?></div>




</div>










<?php 

get_footer(); 

?>
