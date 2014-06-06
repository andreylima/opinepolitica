<?php
global $wp_query;
$post_id = $wp_query->post->ID;


$projetos = new projetosModel($post_id);
$perfis = new perfisModel($projetos->getAutor_projeto());
$autor_id = $projetos->getAutor_projeto();
$curtiu = $perfis->verifica_curtida();
$naocurtiu = $perfis->verifica_naocurtida();
$positivou = $projetos->verifica_positivou();
$negativou = $projetos->verifica_negativou();

get_header('inside'); 

?>
<div class="row-fluid">
  
    <div class="box-autor coluna-lateral">  
      
        <a href="<?php echo get_permalink($autor_id); ?>"><?php  echo get_the_post_thumbnail( $autor_id, array('class' =>'null perfil-size img-circle')); ?></a>
        <a href=""><div class="votes pull-left curtir <?php echo ($curtiu) ? "votado" : ""; ?>" id="<?php echo $autor_id ?>">
            <span class="glyphicon glyphicon-thumbs-up icon-vote">
            
              
            </span>
            <span class="percent-autor">
            <?php echo $perfis->getCurtiu_percent(); ?>
            </span>
        </div>
    </a>

    <a href="">
        <div class="voten pull-right naocurtir <?php echo ($naocurtiu) ? "votado" : ""; ?>" id="<?php echo $autor_id ?>">
            <span class="glyphicon glyphicon-thumbs-down icon-vote">
        
            </span>
            <span class="percent-autor">
            <?php echo $perfis->getNaocurtiu_percent(); ?>
            </span>
        </div>
    </a>
</div>
<div class="caixa-titulo-projeto">
    <img src="http://placehold.it/100x100" class="quem-perguntou">
    <div id="titulo" class="titulo-projeto"><?php the_title(); ?></div>
    <!-- debate ativo desde:  -->
    <!-- situação -->
    <span id="data-proposta" class="data-proposta">
    <label for="data-proposta">Proposto em:</label>
    <input type="date" name="data-proposta" value="<?php ?>" class="pickdate"> 
 </span>
  
    <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>

</div>



</div>
<div class="row-fluid">
    <div class="avaliacao-projeto coluna-lateral">
      <img src="http://placehold.it/200x100" class="img-destaque-apoio"></img>
      <a href="">
      <div class="votes pull-left positivar-projeto <?php echo ($positivou) ? "votado" : ""; ?>" id="<?php echo $post->ID; ?>"> 
       <span class="percent-projeto">
      <?php echo $projetos->getPositivar_percent(); ?>
        </span>
        </div>
      </a>
      <a href="">
      <div class="voten pull-right negativar-projeto <?php echo ($negativou) ? "votado" : ""; ?>" id="<?php echo $post->ID; ?>"> 
        <span class="percent-projeto">
      <?php echo $projetos->getNegativar_percent(); ?>
        </span>
      </div>
    </a>

  </div>

    
    <div id="about" class="conteudo panel panel-default">
      <div class="panel-heading">SOBRE O PROJETO</div>
      <div class="panel-body">
       <?php
       while ( have_posts() ) : the_post();
       the_content();
       endwhile;
        ?>
    </div>
    
    </div>

    <div id="justificativa" class="conteudo panel panel-default">
      <div class="panel-heading">CONSIDERAÇÕES DO AUTOR</div>
      <div class="panel-body">
       <?php
          $consideracoes = get_post_meta( get_the_ID(), 'consideracoes', true );

          if ($consideracoes != "") {
             echo $consideracoes;
          }
          else
          {
            echo "Este é um espaço aberto para considerações do autor a respeito do projeto e de sua aceitação.Se você é o autor, clique aqui.";
          }
         

        ?>
    </div>
    
    </div>

    
    <div class="conteudo">
    <?php comment_form( array( 
    'title_reply' => 'Qual é a sua opnião?', 
    'label_submit' => 'Salvar' , 
    'comment_notes_after' => '', 
    'comment_field' => '<p class="comment-form-comment"><label for="comment">Comente:</label></br><textarea id="comment" name="comment" cols="153" rows="8" aria-required="true"></textarea></p>' ) ); ?>
      
    <div class="comments">
        <ol class='commentlist'>
        <?php
          //Gather comments for a specific page/post 
          $comments = get_comments(array(
            'post_id' =>  $post->ID,
            'status' => 'approve' //Change this to the type of comments to be displayed
          ));

          //Display the list of comments
          wp_list_comments(array(
            'per_page' => 10, //Allow comment pagination
            'reverse_top_level' => false //Show the latest comments at the top of the list
          ), $comments);
        ?>
      </ol>

      </div>
    </div>
<!--   Janela Modal para login ou redirecionamento de registro. -->
    <div id="dialog" class="window">
    <a href="#" class="close">Fechar [X]</a>
  
    <div class="title-modal">Para opinar é necessário estar cadastrado.</div>
    <div class="inner_container">
      <div class="login_container">
            <div class="legend-frmlogin">Entrar</div>
              <form id="formLogin" class="form-vertical well" target="_self" action="" method="POST">
              <div class="control-group">
                <div class="new-fb-btn new-fb-7 new-fb-default-anim"><div class="new-fb-7-1"><div class="new-fb-7-1-1">ENTRAR</div></div></div>
              </div>
              <div class="control-group">
                <label class="control-label" for="username_login">E-mail</label>
                <div class="controls">
                  <input type="text" class="input-large" id="username_login">
                </div>
                </br>
              </div>
              <div class="control-group">
                <label class="control-label" for="username_pass">Senha</label>
                <div class="controls">
                  <input type="password" class="input-large"  id="password_login">
                </div>
              </div>

              <div class="control-group">
                <button type="submit" class="btn btn-primary btn-pos">Entrar</button>
                <a href="" onclick="" class="lnk-recovery-password" data-toggle="modal">Esqueci
                  minha senha</a>
              </div>
            </form>
          
          </div>

    <div class="register-container">
      <div class="legend-registerfrm">Não possui cadastro?</div>
    
    <div class="form-vertical well">
      
          <div class="chamada">É rápido, e fácil. Basta escolher uma das opções abaixo.</div>
          
          <div class="new-fb-btn new-fb-1 new-fb-default-anim"><div class="new-fb-1-1"><div class="new-fb-1-1-1">Registrar com Facebook</div></div></div>
           <div class="register-manual">Registrar Manualmente</div>



    </div>
      

    </div>



    </div>

    </div>
    <div id="mask"></div>
  








  
  </div>

<?php 

get_footer(); 

?>