<?php 

get_header(); 
$denuncias = new tromboneController();
$local_denuncia = get_post_meta(get_the_id(), 'local_denuncia', true  );
$data = get_post_meta(get_the_id(), 'data-denuncia', true  );
?>

<script>
	var templateDir = "<?php bloginfo('template_directory'); ?>";
	
</script>

<div class="single-denuncia-wrapper">

<div class="denuncia-wrapper">

<h3>Data da Denúncia</h3>
<h4><?php echo $data; ?></h4>

<h3><?php the_title(); ?></h3>
<h4> 
<?php while ( have_posts() ) : the_post();

    the_content();

    endwhile;  ?>

</h4>
	


<h3>Local da denúncia</h3>
<h4><?php echo $local_denuncia; ?></h4>
<div id="map-single"></div>
<div class="active-adress"></div>


<h3>Imagem da Denúncia</h3>
<?php echo get_the_post_thumbnail( get_the_ID(),full, array('class'	=> "margin-auto") ); ?> 
<a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Boca no Trombone' ) ) ); ?>" ><div class="ver-mapa-single">VOLTAR PARA O MAPA COMPLETO</div></a>


</div>

    
  <div class="form-comment-denuncia">
    <?php comments_template(); ?>
    </div>


 
  








</div>




<?php 

get_footer(); 

?>