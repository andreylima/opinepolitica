<?php 

get_header(); 

?>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
<div id="page-wrapper-2" class="page-denuncia">
<div class="rd-city hide">Governador Valadares</div>
<div class="rd-state hide">MG</div>
<input id="lat" name="denuncia[latitude]" type="hidden" value="">
<input id="addressField" name="denuncia[endereco]" type="hidden" value="">
<input id="lng" name="denuncia[longitude]" type="hidden" value="">

<h3>1) Endereço</h3>
<h4>Informe o endereço do local denunciado</h4>

<input type="text" placeholder="Buscar Endereço" class="search-adress">
<div id="mapagv-register"></div>
<div class="active-adress"></div>


<h3>2) Dados da Denúncia</h3>
<h4>Dê detalhes sobre a denuncia. </h4>

<div class="wrap-line">
<label for="denuncia-title" class="label-denuncia-title">Título da Denúncia</label>
<input type="text" class="denuncia-title" placeholder="Ex: Buraco, Descaso, Lixo ....">
</div>

<div class="descricao-box">
<label for="descricao-input">Descreva a denúncia:</label>
<textarea name="mensagem" id="mensagem"  rows="5" class="descricao-input" placeholder="Descreva a situação e dê os detalhes que achar necessários." ></textarea>
</div>


<h3>3) Vídeo</h3>
<h4>Nesta área você deve enviar o link de um vídeo da denúncia gravado por você, ou solicitar que o DEBATEGV faça o vídeo. </h4>

<div class="wrap-line">
<div class="youtube-upload-box float-left">
<label for="youtube-video" >Link do vídeo do Youtube:</label>  <input type="text" class="youtube-video" placeholder=" Suba seu vídeo no youtube e cole o link aqui..."> 
</div>

</div>



</div>





<?php 

get_footer(); 

?>