<?php 

get_header(); 

?>
<div id="page-wrapper">
<div class="title-panel">
<h2>Entre em contato com a gente.</h2>
<h3>Sugestões são bem vindas.</h3>
</div>

<div class="form-comment">
<form action="" method="post" id="contato_form" novalidate="novalidate">
<?php if (is_user_logged_in()) { ?>
  <input type="text" id="nome" class="cadastro-input" name="nome" value="<?php echo $current_user->user_firstname.' '.$current_user->user_lastname ?>" hidden>
  <input type="text" id="email" class="cadastro-input" name="email" value="<?php echo $current_user->user_email ?>" hidden>
<?php } else { ?>
  <input type="text" placeholder="Nome" id="nome" class="cadastro-input" name="nome">
  <input type="text" placeholder="Qual é o seu e-mail?" id="email" class="cadastro-input" name="email">
<?php } ?>

  
   <input type="text" placeholder="Assunto" id="assunto" name="assunto" class="cadastro-input">
 	<textarea name="mensagem" id="mensagem"  rows="10" class="text-input"></textarea>



  <input type="submit" name="cadastrar" value="Enviar" id="button-cadastrar" >

</form>
</div>






</div>


<?php 

get_footer(); 

?>