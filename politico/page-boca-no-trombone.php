<?php 

get_header(); 

$denuncias = new tromboneController();

$denuncia_completa = $denuncias->getDenuncia_completa();

$i = 0;
?>


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<div id="page-wrapper-2">
<div><a href="index.php/registrar-denuncia">REGISTRAR DENÚNCIA</a></div>



<div id="mapagv"></div>
<div class="denuncias-list"><?php foreach ($denuncia_completa as $denuncia) {

	echo $denuncia[$i]['latitude'];

	$i += 1;
	
} ?></div>


</div>





<?php 

get_footer(); 

?>