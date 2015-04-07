<?php

get_header();
$reclamacao = new tromboneController();
$local_reclamacao = get_post_meta(get_the_id(), 'local_reclamacao', true  );
$data = get_the_date('d/m/Y');
?>

<script>
	var templateDir = "<?php bloginfo('template_directory'); ?>";

</script>

<div class="single-reclamacao-wrapper">

<div class="reclamacao-wrapper">
<div class="fb-like" data-href="<?php echo get_permalink( $post->ID );  ?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
<h3>Data da Reclamação</h3>
<h4><?php echo $data; ?></h4>

<h3><?php the_title(); ?></h3>
<h4>
<?php while ( have_posts() ) : the_post();

    the_content();

    endwhile;  ?>

</h4>



<h3>Local da Reclamação</h3>
<h4><?php echo $local_reclamacao; ?></h4>
<div id="map-single"></div>
<div class="active-adress"></div>


<h3 class="label-imagem-reclamacao">Imagem da Reclamação</h3>
<?php echo get_the_post_thumbnail( get_the_ID(),full, array('class'	=> "margin-auto") ); ?>
<a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Boca no Trombone' ) ) ); ?>" ><div class="ver-mapa-single">VOLTAR PARA O MAPA COMPLETO</div></a>


</div>


  <div class="form-comment-reclamacao">
    <?php comments_template(); ?>
    </div>












</div>




<?php

get_footer();

?>