<?php

get_header();

?>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
<div id="page-wrapper-2" class="page-reclamacao">
<div class="rd-city hide">Governador Valadares</div>
<div class="rd-state hide">MG</div>
<form action="" method="post" id="reclam_form" novalidate="novalidate" enctype="multipart/form-data">
<input id="addressField" name="reclamacao-endereco" type="hidden" value="">
<input id="lng" name="longitude" type="hidden" value="">
<input id="lat" name="latitude" type="hidden" value="">
<h3>Endereço</h3>
<h4>Informe o endereço do local reclamado no campo de texto ou arraste o marcador até o local correto.</h4>
<?php if ( !is_user_logged_in() ) {
?>
<div class="registered-users-required">
	A Reclamação só pode ser feita por usuários cadastrados.</br> Faça Login e tente novamente.
</div>
<?php
} ?>
<input type="text" placeholder="Buscar Endereço" class="search-adress">
<div id="mapagv-register"></div>
<div class="active-adress"></div>
<div class="aviso-bairro-wrapper">
<h4 class="aviso-bairros">ATENÇÃO. O google é responsável pelo endereço que aparece acima, portanto, caso o nome do bairro estiver diferente do que procura, favor informar o bairro correto no campo de observações a seguir.</h4>
<label for="observacao-bairro">Observações:</label><input name="obs-bairro" type="text" placeholder="Nome do Bairro" class="obs-bairro"><span class="obs-input-bairro ">Preencha somente em caso de erro.</span>
</div>

<div class="aviso-local" >Só continue o preenchimento do formulário se já estiver informado o local da reclamação.</div>


<div class="wrap-line">
<h3>Dados da Reclamação</h3>
<h4>Dê detalhes sobre a reclamação. </h4>
<label for="reclamacao-title" class="label-reclamacao-title">Título da Reclamação</label>
<input type="text" class="reclamacao-title" id="reclamacao_title" name="reclamacao_title" placeholder="Ex: Buraco, Descaso, Lixo ...." >
</div>

<div class="descricao-box">
<label for="descricao_reclamacao">Descreva a Reclamação:</label>
<textarea name="descricao_reclamacao" id="descricao-reclamacao"  rows="5" class="descricao_reclamacao" placeholder="Descreva a situação e dê os detalhes que achar necessários." ></textarea>
</div>


<h3>Imagem da Reclamação</h3>
<h4>Nesta área você carregará a imagem da Reclamação. </h4>

<div class="wrap-line">

<label for="file" >Faça o upload da imagem:</label><input type="file" name="file" id="file"  />




</div>

<?php if ( !is_user_logged_in() ) {
?>
<div class="registered-users-required">
	A Reclamação só pode ser feita por usuários cadastrados.</br> Faça Login e tente novamente.
</div>
<?php
}
else
{?>
<div class="wrap-line">
  <input type="submit" name="registrar-reclamacao" value="REGISTRAR RECLAMAÇÃO" id="registrar-reclamacao" >
 <a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Boca no Trombone' ) ) ); ?>" ><div class="ver-mapa">VOLTAR PARA O MAPA</div></a>
<?php } ?>
</div>
</form>
<div class="reclamacao-sucesso">A Reclamação foi registrada com sucesso, aguarde a aprovação para que ela apareça no mapa. </br>Para realizar outra Reclamação recarregue a página.</div>
<div class="reclamacao-type">O tipo da imagem não é válido.</br>Os tipos permitidos são: jpg, png e jpeg. </div>
<div class="reclamacao-error">Ocorreu um erro durante o upload do arquivo.</br>Recarregue a página e tente novamente. </div>
<div class="reclamacao-size">O tamanho da imagem é muito grande.</br>Favor escolher uma imagem com o tamanho máximo de até 600kb.</div>
<div class="reclamacao-endereco">Favor preencher o local da reclamação.</div>
<?php

get_footer();

?>