<?php 

get_header(); 

?>




<div id="page-wrapper">
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
	<div class="form-comment">
    <?php comment_form( array( 
    'title_reply' => 'Tem algo a nos dizer??</br><h5>Gostaria de deixar uma sugestão para o DebateGV? Adoraríamos receber. Escreva sua mensagem e comente, será um prazer poder saber sua opnião.</h5>', 
    'label_submit' => 'Comentar' , 
     'comment_notes_after' => '', 


     ) ); ?>

    <div class="comments">
        <ol class='commentlist'>
        <?php
          //Gather comments for a specific page/post 
          $comments = get_comments(array(
            'post_id' =>  $post->ID,
            'status' => 'approve' //Change this to the type of comments to be displayed
          ));

          //Display the list of comments
          wp_list_comments(array(
            'per_page' => 10, //Allow comment pagination
            'reverse_top_level' => false //Show the latest comments at the top of the list
          ), $comments);
        ?>
      </ol>

      </div>
    </div>
<?php endwhile; ?>

		</div>
	</div>


	<div class="navigation">
		<div class="next-posts"><?php next_posts_link(); ?></div>
		<div class="prev-posts"><?php previous_posts_link(); ?></div>
	</div>


</div>

<?php get_sidebar(); ?>



</div>















<?php 

get_footer('blog'); 

?>
