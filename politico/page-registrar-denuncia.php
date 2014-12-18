<?php 

get_header(); 

?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<div id="page-wrapper-2" class="page-denuncia">


<h3>1) Endereço</h3>
<h4>Informe o endereço do local denunciado</h4>

<input type="text" placeholder="Buscar Endereço" class="search-adress">
<div id="mapagv-register"></div>
<div class="active-adress"></div>


<h3>2) Dados da Denúncia</h3>
<h4>Dê detalhes sobre a denuncia. Anexar uma foto ou vídeo do Youtube mostrando o local é obrigatório. </h4>

<div class="wrap-line">
<div class="youtube-upload-box float-left">
<label for="youtube-video"  >Link do vídeo do Youtube:</label>  <input type="text" class="youtube-video"> 
</div>
<span class="ou-format">ou</span> 
<div class="img-upload-box float-right">
<label for="img-denuncia" > Upload de imagem: </label><input type="file" class="img-denuncia">
</div>
</div>

<div class="descricao-box">
<label for="descricao-input">Faça a sua denúncia:</label>
<textarea name="mensagem" id="mensagem"  rows="10" class="descricao-input"></textarea>
</div>

</div>





<?php 

get_footer(); 

?>