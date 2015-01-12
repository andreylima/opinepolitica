<?php 

get_header(); 

?>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
<div id="page-wrapper-2" class="page-denuncia">
<div class="rd-city hide">Governador Valadares</div>
<div class="rd-state hide">MG</div>
<form action="" method="post" id="denuncia_form" novalidate="novalidate">
<input id="addressField" name="denuncia[endereco]" type="hidden" value="">
<input id="lng" name="denuncia[longitude]" type="hidden" value="">
<input id="lat" name="denuncia[latitude]" type="hidden" value="">
<h3>1) Endereço</h3>
<h4>Informe o endereço do local denunciado no campo de texto ou arraste o marcador até o local correto.</h4>
<?php if ( !is_user_logged_in() ) { 
?>
<div class="registered-users-required">
	A denúncia só pode ser feita por usuários cadastrados.</br> Faça Login e tente novamente.
</div>
<?php
} ?>
<input type="text" placeholder="Buscar Endereço" class="search-adress">
<div id="mapagv-register"></div>
<div class="active-adress"></div>


<h3>2) Dados da Denúncia</h3>
<h4>Dê detalhes sobre a denuncia. </h4>

<div class="wrap-line">
<label for="denuncia-title" class="label-denuncia-title">Título da Denúncia</label>
<input type="text" class="denuncia-title" name="denuncia_title" placeholder="Ex: Buraco, Descaso, Lixo ...." >
</div>

<div class="descricao-box">
<label for="descricao_denuncia">Descreva a denúncia:</label>
<textarea name="descricao_denuncia" id="descricao-denuncia"  rows="5" class="descricao_denuncia" placeholder="Descreva a situação e dê os detalhes que achar necessários." ></textarea>
</div>


<h3>3) Vídeo</h3>
<h4>Nesta área você deve enviar o link de um vídeo da denúncia gravado por você, ou solicitar que o DEBATEGV faça o vídeo. </h4>

<div class="wrap-line">
<div class="youtube-upload-box float-left">
<label for="youtube-video" >Link do vídeo do Youtube:</label>  <input type="text" class="youtube-video" placeholder=" Suba seu vídeo no youtube e cole o link aqui..."> 
<div class="tip-link">O vídeo deve mostrar o problema apontado na denúncia.</div>
</div>
<div class="option-video "> 
<div class="debate-filma-box">
<input type="radio" name="debate-video" class="debate-video" value="yes">
<label for="debate-video" class="debate-video-label">Gostaria que o DEBATEGV fizesse o vídeo da denúncia.</label>
<div class="tip-link">O DEBATEGV irá até o local da denúncia fazer a gravação do vídeo.</div>
</div>
<div class="user-personagem-box">
<input type="checkbox" name="user-personagem" class="user-personagem" value="yes">
<label for="user-personagem">Gostaria de ser um personagem do vídeo.</label>
<div class="tip-link">O DEBATEGV entrará em contato por e-mail para combinar o melhor horário para a gravação.</div>
</div>
</div>

</div>

<?php if ( !is_user_logged_in() ) { 
?>
<div class="registered-users-required">
	A denúncia só pode ser feita por usuários cadastrados.</br> Faça Login e tente novamente.
</div>
<?php
}
else
{?>
  <input type="submit" name="registrar-denuncia" value="REGISTRAR DENÚNCIA" id="registrar-denuncia" >

<?php } ?>
</form>


<?php 

get_footer(); 

?>