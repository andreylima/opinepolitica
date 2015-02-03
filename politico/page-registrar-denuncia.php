<?php 

get_header(); 

?>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
<div id="page-wrapper-2" class="page-denuncia">
<div class="rd-city hide">Governador Valadares</div>
<div class="rd-state hide">MG</div>
<form action="" method="post" id="denuncia_form" novalidate="novalidate">
<input id="addressField" name="denuncia-endereco" type="hidden" value="">
<input id="lng" name="longitude" type="hidden" value="">
<input id="lat" name="latitude" type="hidden" value="">
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
<div class="aviso-bairro-wrapper">
<h4 class="aviso-bairros">ATENÇÃO. O google é responsável pelo endereço que aparece acima, portanto, caso o nome do bairro estiver diferente do que procura, favor informar o bairro correto no campo de observações a seguir.</h4>
<label for="observacao-bairro" class="float-left">Observações:</label><input name="obs-bairro" type="text" placeholder="Nome do Bairro" class="obs-bairro float-left"><span class="obs-input-bairro float-left">Preencha somente em caso de erro.</span>
</div>

<div class="aviso-local" >Só continue o preenchimento do formulário se já estiver informado o local da denúncia.</div>


<div class="wrap-line">
<h3>2) Dados da Denúncia</h3>
<h4>Dê detalhes sobre a denuncia. </h4>
<label for="denuncia-title" class="label-denuncia-title">Título da Denúncia</label>
<input type="text" class="denuncia-title" name="denuncia_title" placeholder="Ex: Buraco, Descaso, Lixo ...." >
</div>

<div class="descricao-box">
<label for="descricao_denuncia">Descreva a denúncia:</label>
<textarea name="descricao_denuncia" id="descricao-denuncia"  rows="5" class="descricao_denuncia" placeholder="Descreva a situação e dê os detalhes que achar necessários." ></textarea>
</div>


<h3>3) Imagem da Reclamação</h3>
<h4>Nesta área você carregará a imagem da Reclamação. </h4>

<div class="wrap-line">
<div class="youtube-upload-box float-left">
<label for="youtube-video" >Faça o upload da imagem:</label><input type="file"> 

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
<div class="wrap-line">
  <input type="submit" name="registrar-denuncia" value="REGISTRAR DENÚNCIA" id="registrar-denuncia" >
 <a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Boca no Trombone' ) ) ); ?>" ><div class="ver-mapa">VOLTAR PARA O MAPA</div></a>
<?php } ?>
</div>
</form>
<div class="denuncia-sucesso">A denúncia foi registrada com sucesso, aguarde a aprovação para que ela apareça no mapa. </br>Para realizar outra denúncia recarregue a página.</div>

<?php 

get_footer(); 

?>