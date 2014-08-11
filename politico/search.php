<?php get_header(); ?>
<<<<<<< HEAD

	<div id="page-wrapper">

		<div class="column span-9 first" id="maincontent">

			<div class="content">

	<?php if (have_posts()) : ?>

		<h2 class="title-panel big-header">Resultado das buscas para: "<?php echo $s ?>"</h2>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Previous') ?></div>
			<div class="alignright"><?php previous_posts_link('Next &raquo;') ?></div>
		</div>
		
		<div class="clear"></div>

		<?php while (have_posts()) : the_post(); ?>

			<div class="post" id="post-<?php the_ID(); ?>">

				<p class="large nomargin"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></p>
				<?php
				// Support for "Search Excerpt" plugin
				// http://fucoder.com/code/search-excerpt/
				if ( function_exists('the_excerpt') && is_search() ) {
					the_excerpt();
				} ?>
				<p class="small">
					<?php the_time('F jS, Y') ?> &nbsp;|&nbsp; 
					<!-- by <?php the_author() ?> -->
					Published in
					<?php the_category(', ');
						if($post->comment_count > 0) { 
								echo ' &nbsp;|&nbsp; ';
								comments_popup_link('', '1 Comment', '% Comments'); 
						}
					?>
				</p>
				
			</div>
			
			<hr>
		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Previous') ?></div>
			<div class="alignright"><?php previous_posts_link('Next &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">No posts found. Try a different search?</h2>
		

	<?php endif; ?>

		</div> <!-- /content -->
	</div> <!-- /maincontent-->

	<?php get_sidebar(); ?>

	</div> <!-- /page -->
=======
            
            <div id="page-wrapper" class="clearfix row seach-results">
            
                <div id="main" >
                
                    <div class="title-panel text-center big-header">
                        <h1>Resultado das pesquisas para: <?php echo esc_attr(get_search_query()); ?></h1>
                    </div>

                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix article-search'); ?> role="article">
                        
                        
                            
                            <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                                              
                      
                    
                        <section class="post_content">
                            <?php the_excerpt(); ?>
                    
                        </section> <!-- end article section -->
                        
                        <footer>
                    
                            
                        </footer> <!-- end article footer -->
                    
                    </article> <!-- end article -->
                    
                    <?php endwhile; ?>  
                    
                
                        <nav class="wp-prev-next">
                            <ul class="clearfix">
                                <li class="prev-link"><?php next_posts_link() ?></li>
                                <li class="next-link"><?php previous_posts_link() ?></li>
                            </ul>
                        </nav>
                             
                    
                    <?php else : ?>
                    
                    <!-- this area shows up if there are no results -->
                    
                    <article id="post-not-found">
                        <header>
                            <h1>Nada encontrado :(</h1>
                        </header>
                        <section class="post_content">
                            <p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
                        </section>
                        <footer>
                        </footer>
                    </article>
                    
                    <?php endif; ?>
            
                </div> <!-- end #main -->
                
                <?php get_sidebar(); // sidebar 1 ?>
    
            </div> <!-- end #content -->
>>>>>>> origin/master

<?php get_footer(); ?>