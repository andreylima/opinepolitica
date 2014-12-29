<?php 

get_header(); 

$denuncias = new tromboneController();

$denuncia_completa = $denuncias->getDenuncia_completa();



?>
<script>
	var templateDir = "<?php bloginfo('template_directory'); ?>";
</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<div id="page-wrapper-2">
<div><a href="index.php/registrar-denuncia">REGISTRAR DENÚNCIA</a></div>



<div id="mapagv"></div>
<div class="denuncias-list"><?php foreach ($denuncia_completa as $denuncia) {

	echo $denuncia['id'];

		
} ?></div>


</div>





<?php 

get_footer(); 

?>