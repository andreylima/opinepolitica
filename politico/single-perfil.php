<?php 

get_header(); 

$perfis = new perfisModel(get_the_ID());
$curtiu = $perfis->verifica_curtida();
$naocurtiu = $perfis->verifica_naocurtida();
$partidos = wp_get_post_terms( get_the_ID(), 'Partidos',array("fields" => "names"));

?>


<div id="single-perfil-wrapper">
  <div class="info-perfil-wrapper">
    <div class="box-autor coluna-lateral">  

        <?php  echo get_the_post_thumbnail( get_the_ID(), array('class' =>'null perfil-size-single img-circle')); ?>
        <a href=""><div class="votes pull-left curtir <?php echo ($curtiu) ? "votado" : ""; ?>" id="<?php echo get_the_ID() ?>">
            <span class="glyphicon glyphicon-thumbs-up icon-vote">


            </span>
            <span class="percent-both percent-curtiu">
                <?php echo $perfis->getCurtiu_percent(); ?>
            </span>
        </div>
    </a>
    <a href="">
        <div class="voten pull-right naocurtir <?php echo ($naocurtiu) ? "votado" : ""; ?>" id="<?php echo get_the_ID() ?>">
            <span class="glyphicon glyphicon-thumbs-down icon-vote">

            </span>
            <span class="percent-both percent-naocurtiu">
                <?php echo $perfis->getNaocurtiu_percent(); ?>
            </span>
        </div>
    </a>
</div>
<div class="info-perfil">
<div id="titulo" class="titulo-single-mobile"><?php the_title(); ?></div>
<div class="partido">Partido: 
     <?php 
     echo $partidos[0];
     ?>
 </div>
     <span class="mandato">Mandato: <?php echo $perfis->getMandato(); ?></span> 

    <?php 

    echo "<span class='total_votos'>Total de avaliações: <span class='n_votos'>".$perfis->get_total_votos()."</span></span>";


    $projetos_debatidos = get_post_meta( get_the_ID(), 'projetos_debatidos', true ); 
    if (!empty($projetos_debatidos)) {
           $projetos_debatidos = count(array_filter($projetos_debatidos));
       }
    else
    {
        $projetos_debatidos = "0";
    }


    echo "<span class='total_debatidos'>Projetos Cadastrados: ".$projetos_debatidos."</span>";

    ?>
</div>
</div>
<div class="conteudo">
  
<div class="caixa-titulo">
    
 <div id="titulo" class="titulo-single"><?php the_title(); ?></div>
 <div class="fb-like" data-href="<?php echo get_permalink( $post->ID );  ?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>

</div>



<div class="panel panel-default debatidos">
  <div class="panel-heading title-projeto-single">PERFIL</div>
  <div class="panel-body">
    <?php while ( have_posts() ) : the_post();

    the_content();

    endwhile;
    ?>




</div>
</div>



<div class="panel panel-default debatidos">
  <div class="panel-heading title-projeto-single">PROJETOS DELE</div>
  <div class="panel-body">
  <div class="mini-projeto-wrapper">
      
  
    <?php 
    $id_perfil = get_the_ID();
    $the_query = new WP_Query(array( 'post_type' => 'projeto', 'meta_key' => 'autoria', 'meta_value' => $id_perfil ));

    if ($the_query->have_posts()) {

    while ( $the_query->have_posts() ) : $the_query->the_post(); 

   
       
    $projetos = new projetosModel($post->ID);
    $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
    $situacao = get_post_meta( $post->ID, 'situacao',true);
    ?>

    <div class="panel panel-default mini-projeto">
                <div class="panel-heading mini-projeto-header"><a href="<?php echo $permalink; ?>"><?php echo the_title(); ?></a></div>
                <div class="panel-body">
                    <a href="<?php echo the_permalink();; ?>"><div class="pic-projeto  <?php echo $situacao; ?>" style="background-image: url('<?php echo $url; ?>');">
                    </div> 
                    </a>     
                    <div class="projeto-excerpt">
                        <a href="<?php echo the_permalink();; ?>"><?php echo the_excerpt(); ?></a>
                    </div>
                    <div class="panel-bottom">
                        <a href="<?php echo the_permalink();; ?>">
                            <div class="see-more">
                                SAIBA MAIS
                            </div>
                        </a>
                        <div class="percent-wrapper">
                        <a href="<?php echo the_permalink();; ?>">
                        <span class="mini-percent-naoapoiaram">
                            <span class="glyphicon glyphicon-thumbs-down mini-icon-n"></span>
                            <?php echo $projetos->getNegativar_percent(); ?>
                        </span>
                        </a>
                        <a href="<?php echo the_permalink();; ?>">
                        <span class="mini-percent-apoiaram">
                            <span class="glyphicon glyphicon-thumbs-up mini-icon-s"></span>
                            <?php echo $projetos->getPositivar_percent(); ?>
                        </span>
                        </a>
                        </div>
                    </div>
                </div>

            </div>

            <?php endwhile;

        }
        else
        {
            
        echo "<span> Ainda não foram cadastrados projetos desse Político. Clique <a href='".esc_url( get_permalink( get_page_by_title( 'contato' ) ) )."'>AQUI</a> e faça sua sugestão.</a></span>";

        } 
        wp_reset_postdata();
         
        ?>
          </div>
        </div>
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