<?php get_header(); ?>
            
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
                
    
    
            </div> <!-- end #content -->

<?php get_footer(); ?>