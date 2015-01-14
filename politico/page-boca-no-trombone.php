<?php 

get_header(); 

$denuncias = new tromboneController();
$denuncias->set_bairros_gv();
$bairros = $denuncias->get_bairros_gv();


?>
<script>
	var templateDir = "<?php bloginfo('template_directory'); ?>";
	
</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<div id="page-wrapper-3">



<div class="coluna-1">
<div id="mapagv"></div>
</div>
<div class="coluna-2">
 <a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Registrar Denúncia' ) ) ); ?>" ><input type="submit" name="denunciar" value="DENUNCIAR" class="denunciar" ></a>
<div class="total_denuncias"><?php echo "<span class='number_denuncia'>".$denuncias->get_qtd_denuncias()."</span>" ?> Denúncias registradas até o momento </div>
<div class="total_resolvidas"><?php echo "<span class='number_denuncia'>".$denuncias->get_qtd_resolvidas()."</span>" ?> Denúncias Resolvidas </div>
<div class="percent_resolvidas"><?php echo "<span class='number_denuncia'>".$denuncias->get_percent_resolvidas()."</span>" ?> de eficiência</div>
<div class="title_filtrar">FILTRAR POR BAIRRO</div>
<select name="bairro_denuncia" id="bairro_denuncia">
<option value="">Bairros</option>
<?php
  foreach ($bairros as $bairro) { ?>
      <option value="<?php echo $bairro ?>"><?php echo $bairro ?></option>
<?php
  }
?>
  </select>
<input type="button" value="Mostrar todas" id="show_all">

 <div id="denuncias_list">

</div>
	
		


</div> 


</div>






</div>





<?php 

get_footer(); 

?>