<?php 

get_header(); 

?>
<div id="page-wrapper">
<div class="panel panel-default">
  <div class="panel-heading">
    Termos de Serviço e Sigilo do DebateGV
  </div>
  <div class="panel-body">
   <div id="content" class="widecolumn">
 <?php if (have_posts()) : while (have_posts()) : the_post();?>

  <?php the_content(); ?>


 <?php endwhile; endif; ?>
 <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
</div>
  </div>
</div>
</div>



<?php 

get_footer(); 

?>