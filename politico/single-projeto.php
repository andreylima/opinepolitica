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

get_header(); 

?>
<div id="single-wrapper">
  <div class="info-perfil-wrapper coluna-lateral">
  <div class="overflow-autor">
    <div class="box-autor">  
      <div class="autor-titulo">AUTOR DO PROJETO</div>
        <a href="<?php echo get_permalink($autor_id); ?>"><?php  echo get_the_post_thumbnail( $autor_id, array('class' =>'null perfil-size-single img-circle')); ?></a>
        <div class="votes pull-left curtir <?php echo ($curtiu) ? "votado" : ""; ?>" id="<?php echo $autor_id ?>">
            <span class="glyphicon glyphicon-thumbs-up icon-vote">
            
              
            </span>
            <span class="percent-both percent-curtiu">
            <?php echo $perfis->getCurtiu_percent(); ?>
            </span>
        </div>
    

    
        <div class="voten pull-right naocurtir <?php echo ($naocurtiu) ? "votado" : ""; ?>" id="<?php echo $autor_id ?>">
            <span class="glyphicon glyphicon-thumbs-down icon-vote">
        
            </span>
            <span class="percent-both percent-naocurtiu">
            <?php echo $perfis->getNaocurtiu_percent(); ?>
            </span>
        </div>
    
</div>
</div>
<h4 class="name-perfil"><?php echo get_the_title($autor_id); ?></h4>
<a href="<?php echo get_permalink($autor_id); ?>" class="ver-perfil-buttton"><div class="link-perfil">VER PERFIL</div></a>
  <div class="avaliacao-projeto ">
      <div class="avalie">Avalie o Projeto</div>
      
      <div class="votes pull-left  positivar-projeto <?php echo ($positivou) ? "votado" : ""; ?>" id="<?php echo $post->ID; ?>"> 
<span class="glyphicon glyphicon-thumbs-up icon-vote">
        
            </span>
       <span class="percent-both percent-curtiu">
      <?php echo $projetos->getPositivar_percent(); ?>
        </span>
        </div>
     
      
      <div class="voten pull-right negativar-projeto <?php echo ($negativou) ? "votado" : ""; ?>" id="<?php echo $post->ID; ?>"> 
        <span class="glyphicon glyphicon-thumbs-down icon-vote">
        
            </span>
        <span class="percent-both percent-naocurtiu">
      <?php echo $projetos->getNegativar_percent(); ?>
        </span>
      </div>
    
    </div>
</div>
<div class="conteudo">
<div class="caixa-titulo">
    
    <div id="titulo" class="titulo-projeto"><?php the_title(); ?></div>
    
    <span id="data-proposta" class="data-proposta">
    
    <div class="data-text">Proposto em:  <?php echo date('d/m/Y',strtotime(get_post_meta( $post_id, 'data_proposta', true)) ); ?></div>
    
 </span>
  

</div>

    
    <div class="panel panel-default debatidos">
  <div class="panel-heading title-projeto-single">SOBRE O PROJETO</div>
      <div class="panel-body">
        <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
        <div class="pic-projeto" style="background-image: url('<?php echo $url; ?>');">

        </div> 
        <div class="project-content">
       <?php
       while ( have_posts() ) : the_post();
       the_content();
       endwhile;
        ?>
        </div>
    </div>
    
    </div>

    <div id="justificativa" class="panel panel-default debatidos">
      <div class="panel-heading font-header-small">CONSIDERAÇÕES DO AUTOR</div>
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

    
    <div class="form-comment">
    <?php comment_form( array( 
    'title_reply' => 'Qual é a sua opnião?', 
    'label_submit' => 'Comentar' , 
    'comment_notes_after' => '', 
    'comment_field' => '<p class="comment-form-comment"><label for="comment">Comente:</label></br><textarea id="comment" name="comment"  rows="8" aria-required="true"></textarea></p>' ) ); ?>
      
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
    </div>
<!--   Janela Modal para login ou redirecionamento de registro. -->
    <div id="dialog" class="window">
    <a href="#" class="close">Fechar [X]</a>
  
    <div class="title-modal">Para opinar é necessário estar cadastrado.</div>
    <div class="inner_container">
      <div class="login_container">
            
              <form id="formLogin" class="form-vertical well"  action="" method="POST" novalidate="novalidate">
              <div class="control-group">
                <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>
              </div>
              <div class="control-group">
                
                <div class="controls">
                  <input type="text" class="input-large" id="email_log" name="email_log" placeholder="e-mail">
                </div>
               </div>
              <div class="control-group">
                <div class="controls">
                  <input type="password" class="input-large"  id="senha_log" name="senha_log" placeholder="senha">
                </div>
              </div>

              <div class="control-group">
                <button type="submit" class="btn-entrar">Entrar</button>
                <a href="" onclick="" class="lnk-recovery-password" data-toggle="modal">Esqueci
                  minha senha</a>
              </div>
              <div class="show-error-modal"> </div>
            </form>
          
          </div>

    <div class="register-container">
     
    
    <div class="form-vertical well">
         <div class="legend-registerfrm">Não possui cadastro?</div> 
         <div class="face-button-modal">             
            <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>
</div>
          <div id="register-manual-inside">Registrar Manualmente</div>



    </div>
      

    </div>
    </div>
    </div>

    <div id="mask"></div>
  








  
  </div>

<?php 

get_footer(); 

?>