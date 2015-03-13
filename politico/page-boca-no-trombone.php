<?php

get_header();

$reclamacao = new tromboneController();
$reclamacao->set_bairros_gv();
$bairros = $reclamacao->get_bairros_gv();


?>
<script>
	var templateDir = "<?php bloginfo('template_directory'); ?>";

</script>


<div id="page-wrapper-3">



<div class="coluna-1">
<div id="mapagv"></div>
</div>
<div class="coluna-2">
 <a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Registrar Reclamação' ) ) ); ?>" ><input type="submit" name="reclamar" value="Reclamar" class="reclamar" ></a>
<div class="total_reclamacao"><?php echo "<span class='number_reclamacao'>".$reclamacao->get_qtd_reclamacoes()."</span>" ?> Reclamaçãos registradas até o momento </div>
<div class="total_resolvidas"><?php echo "<span class='number_reclamacao'>".$reclamacao->get_qtd_resolvidas()."</span>" ?> Reclamaçãos Resolvidas </div>
<div class="percent_resolvidas"><?php echo "<span class='number_reclamacao'>".$reclamacao->get_percent_resolvidas()."</span>" ?> de eficiência</div>
<div class="title_filtrar">FILTRAR POR BAIRRO</div>
<select name="bairro_reclamacao" id="bairro_reclamacao">
<option value="">Bairros</option>
<?php
  foreach ($bairros as $bairro) { ?>
      <option value="<?php echo $bairro ?>"><?php echo $bairro ?></option>
<?php
  }
?>
  </select>
<input type="button" value="Mostrar todas" id="show_all">

 <div id="reclamacao_list">

</div>




</div>


</div>






</div>





<?php

get_footer();

?>