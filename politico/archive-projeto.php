<?php 

get_header();



?>

<div id="archive-wrapper">

  <div class="title-panel text-center big-header">
    <h1>Conheça mais sobre cada Projeto,</h1> 
    <h2>dê a sua opinião,</h2> 
    <h1>e mostre que estamos de olho!</h1>
  </div>

  <div class="title-panel text-center small-header">
    <h4>Conheça mais sobre cada Projeto,</h4> 
    <h4>dê a sua opinião,</h4> 
    <h4>e mostre que estamos de olho!</h4>
  </div>
<?php get_search_form(); ?>
<div class="todos-projetos" id="container">
	
<?php $loop = new WP_Query( array( 'post_type' => 'projeto' , 'posts_per_page' => -1) ); 

 while ( $loop->have_posts() ) : $loop->the_post(); 

 $projetos = new projetosModel($post->ID);
 ?>
         

<div class="panel panel-default mini-projeto" >
                <div class="panel-heading mini-projeto-header"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></div>
                <div class="panel-body">
                    <?php 
                    $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
                    $situacao = get_post_meta( $post->ID, 'situacao',true);

                    ?>

                    <a href="<?php echo the_permalink(); ?>">


                    <div class="pic-projeto <?php echo $situacao; ?>" style="background-image: url('<?php echo $url; ?>');">
                    
                    </div>  
                    </a>    
                    <div class="projeto-excerpt">
                        <a href="<?php echo the_permalink(); ?>"><?php echo the_excerpt(); ?></a>
                    </div>
                    <div class="panel-bottom">
                        <a href="<?php echo the_permalink(); ?>">
                            <div class="see-more">
                                SAIBA MAIS
                            </div>
                        </a>
                         <div class="percent-wrapper">
                         <a href="<?php echo the_permalink(); ?>">
                        <span class="mini-percent-naoapoiaram">
                            <span class="glyphicon glyphicon-thumbs-down mini-icon-n"></span>
                            <?php echo $projetos->getNegativar_percent(); ?>
                        </span>
                        </a>
                        <a href="<?php echo the_permalink(); ?>">
                        <span class="mini-percent-apoiaram">
                            <span class="glyphicon glyphicon-thumbs-up mini-icon-s"></span>
                            <?php echo $projetos->getPositivar_percent(); ?>
                        </span>
                        </a>
                    </div>
                    </div>
        <div class="first-comments"> 
      <span>Total de comentários: <?php echo get_comments_number( $post->ID ); ?> </span>  
        <div class="comments">
        <ol class='commentlist'>
        <?php
          //Gather comments for a specific page/post 
          $comments = get_comments(array(
            'number' => '3',
            'post_id' =>  $post->ID,
            'status' => 'approve' //Change this to the type of comments to be displayed
          ));

          //Display the list of comments
          wp_list_comments(array(
            'per_page' => 3, //Allow comment pagination
            'reverse_top_level' => false //Show the latest comments at the top of the list
          ), $comments);
        ?>
      </ol>

      </div>
    </div>

    </div>

            </div>




<?php endwhile; ?>




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
<?php get_footer() ?>