<?php 

get_header(); 
$denuncias = new tromboneController();
$link_video =  get_post_meta( get_the_id(), 'link_video', true );
$link_video = explode("=",$link_video);

?>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

<div class="single-denuncia-wrapper">
	

<h3><?php the_title(); ?></h3>
<h4> 
<?php while ( have_posts() ) : the_post();

    the_content();

    endwhile;  ?>

</h4>

<h3>Local da denúncia</h3>
<div id="map-single"></div>
<div class="active-adress"></div>

<h3>Vídeo</h3>
<iframe id="link_video-single" style="width:600px;height:430px;background-color:black"  src="//www.youtube.com/embed/<?php echo $link_video[1]; ?>" frameborder="0" allowfullscreen ALT="carregando video"></iframe>


<?php  print_r( get_post_type()); ?>








</div>




<?php 

get_footer(); 

?>