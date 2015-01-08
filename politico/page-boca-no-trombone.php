<?php 

get_header(); 

$denuncias = new tromboneController();

$denuncia_completa = $denuncias->getDenuncia_completa();
$denuncias->set_bairros_gv();
$bairros = $denuncias->get_bairros_gv();


?>
<script>
	var templateDir = "<?php bloginfo('template_directory'); ?>";
	
</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<div id="page-wrapper-2">



<div class="coluna-1">
<div id="mapagv"></div>
</div>
<div class="coluna-2">
<div class="total_denuncias"><?php echo $denuncias->get_qtd_denuncias(); ?> Denúncias registradas até o momento </div>
<div class="total_denuncias"><?php echo $denuncias->get_qtd_resolvidas(); ?> Denúncias Resolvidas </div>
<div class="percent_resolvidas"><?php echo $denuncias->get_percent_resolvidas(); ?> de eficiência</div>

<select name="bairro_denuncia" id="bairro_denuncia">
<?php
  foreach ($bairros as $bairro) { ?>
      <option value="<?php echo $bairro ?>"><?php echo $bairro ?></option>
<?php
  }
?>
  </select>
<input type="button" value="teste2" id="clear2">

<!-- <div class="denuncias-list"><?php foreach ($denuncia_completa as $denuncia) {

	echo $denuncia['id'];

		
} ?></div> -->
</div>






</div>





<?php 

get_footer(); 

?>