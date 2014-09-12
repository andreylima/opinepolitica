<?php 

get_header(); 

global $post;

$perfis = new perfisModel($post->ID);


?>

<div id="page-wrapper">
<img src="<?php echo get_stylesheet_directory_uri().'/assets/img/logo400x400.png' ?>" alt="DEBATEGV" id="logo-quem-somos">
<div class="panel panel-default">
  <div class="panel-heading">
  O QUE SOMOS
  </div>
  <div class="panel-body">
  Somos um site particular que reúne projetos de Lei propostos pelos políticos de Governador Valadares, e os apresenta de uma maneira clara, objetiva e imparcial, disponibilizando nosso espaço para que os eleitores discutam a respeito desses projetos e possam fazer suas escolhas com base no que realmente importa. Também é possível declarar seu apoio ao projeto e aos políticos autores dos mesmos. Não somos filiados a nenhum partido político.
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
  O PROJETO
  </div>
  <div class="panel-body">
  O DebateGV é um projeto que foi desenvolvido para ser apresentado como Trabalho de Conclusão do Curso de Sistemas de Informação da Universidade Vale do Rio Doce – Governador Valadares, período 2011 – 2014.
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
  O OBJETIVO
  </div>
  <div class="panel-body">
  O DebateGV tem o objetivo de estimular os eleitores a se envolverem em discussões políticas a respeito dos Projetos de Lei propostos por políticos de  Governador Valadares. Esse projeto procura ajudar na solução de um problema da sociedade, que é a falta de conscientização política, de interesse político e o acomodo com a corrupção. Todo o conteúdo do site é público e dará condições aos usuários de tirarem suas conclusões sobre o trabalho de cada político. Ficará por nossa conta, encaminhar os resultados dessa participação popular a cada autor de Projeto de Lei.
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
  MISSÃO
  </div>
  <div class="panel-body">
  Conscientização política
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
  QUEM SOMOS
  </div>
  <div class="panel-body">
  
<?php $loop = new WP_Query( array( 'post_type' => 'equipe' , 'posts_per_page' => 100, 'orderby'=> 'title', 'order' => 'asc') ); ?>
  <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
  <?php 
      $perfis = new perfisModel($post->ID);
      $curtiu = $perfis->verifica_curtida();
      $naocurtiu = $perfis->verifica_naocurtida();

  ?>

<div class="panel panel-default integrantes">
  <div class="panel-heading">
  <?php the_title() ?>
  </div>
  <div class="panel-body">
<div class="integrante-wrapper">


    <div class="thumb-wrap">
      <div class="thumb">
        <?php the_post_thumbnail('thumbnail', array('class' => 'img-circle perfil-size')); ?>
        <a href="">
        <div class="votes pull-left curtir <?php echo ($curtiu) ? "votado" : ""; ?>" id="<?php echo $post->ID; ?>">
        <span class="glyphicon glyphicon-thumbs-up icon-vote">
          
        </span>
        <span class="percent-both percent-curtiu">
              <?php 
            $perfis = new perfisModel($post->ID);
            echo $perfis->getCurtiu_percent(); 

            ?>
            </span>
        </div>
        </a>
        <a href=""> 
        <div class="voten pull-right naocurtir <?php echo ($naocurtiu) ? "votado" : ""; ?>" id="<?php echo $post->ID; ?>">
        <span class="glyphicon glyphicon-thumbs-down icon-vote">
          
        </span>
        <span class="percent-both percent-naocurtiu">
               <?php 
            $perfis = new perfisModel($post->ID);
            echo $perfis->getNaocurtiu_percent(); 

            ?>
            </span>
        </div>
        </a>
      </div>
      </div>
           
  

	

</div>
<div class="integrante-perfil-wrapper">
	<h3 class="integrante-perfil"><?php the_content() ?></h3>
</div>

</div>
</div>
<?php endwhile; ?>	



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
               <div class="control-group face-modal">
                
                  <?php do_action( 'wordpress_social_login' ); ?>
               
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
             <?php do_action( 'wordpress_social_login' ); ?>
          </div>
          <div id="register-manual-inside">Registrar Manualmente</div>



    </div>
      

    </div>
    </div>
    </div>

    <div id="mask"></div>
<?php 

get_footer(); 

?>