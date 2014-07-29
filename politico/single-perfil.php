<?php 

get_header(); 

$perfis = new perfisModel(get_the_ID());
$curtiu = $perfis->verifica_curtida();
$naocurtiu = $perfis->verifica_naocurtida();
$partidos = wp_get_post_terms( get_the_ID(), 'Partidos',array("fields" => "names"));

?>


<div id="single-wrapper">
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
    <?php 

    $projetos_debatidos = get_post_meta( get_the_ID(), 'projetos_debatidos', true ); 
    if (!empty($projetos_debatidos)) {
           $projetos_debatidos = count(array_filter($projetos_debatidos));
       }
    else
    {
        $projetos_debatidos = "0";
    }


    ?>
    <?php  echo $projetos_debatidos; ?> Projetos Cadastrados

</div>
</div>
<div class="conteudo">
  
<div class="caixa-titulo">
    <div class="partido">
     <?php 
     echo $partidos[0];
     ?>
 </div>

 <div id="titulo" class="titulo-perfil"><?php the_title(); ?></div>
 <div class="mandato">
    <span class="label_n_mandato">Mandato:</span>
    <span class="n_mandato"><?php echo $perfis->getMandato(); ?></span> 
</div>



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
    $projetos_debatidos = get_post_meta( get_the_ID(), 'projetos_debatidos', true );

    if (!empty($projetos_debatidos)) {
            # code...

        foreach ($projetos_debatidos as $projeto) {
            $projeto_dados = get_post($projeto);
            $projetos = new projetosModel($projeto_dados->ID);
            $permalink = get_permalink( $projeto );

            ?>
            <div class="panel panel-default mini-projeto">
                <div class="panel-heading mini-projeto-header"><a href="<?php echo $permalink; ?>"><?php echo $projeto_dados->post_title; ?></a></div>
                <div class="panel-body">
                    <a href="<?php echo $permalink; ?>"><div class="pic-projeto" style="background-image: url('http://www.apostasfc.com/blog/wp-content/uploads/2014/05/apostas-desportivas_Portugal_TVI_maisfutebol_Aposta-X.jpg');">
                    </div> 
                    </a>     
                    <div class="projeto-excerpt">
                        <a href="<?php echo $permalink; ?>"><?php echo $projeto_dados->post_excerpt; ?></a>
                    </div>
                    <div class="panel-bottom">
                        <a href="<?php echo $permalink; ?>">
                            <div class="see-more">
                                SAIBA MAIS
                            </div>
                        </a>
                        <div class="percent-wrapper">
                        <a href="<?php echo $permalink; ?>">
                        <span class="mini-percent-naoapoiaram">
                            <span class="glyphicon glyphicon-thumbs-down mini-icon-n"></span>
                            <?php echo $projetos->getNegativar_percent(); ?>
                        </span>
                        </a>
                        <a href="<?php echo $permalink; ?>">
                        <span class="mini-percent-apoiaram">
                            <span class="glyphicon glyphicon-thumbs-up mini-icon-s"></span>
                            <?php echo $projetos->getPositivar_percent(); ?>
                        </span>
                        </a>
                        </div>
                    </div>
                </div>

            </div>

            <?php } 

        }
        else
        {
            ?>
        <span> Ainda não foram cadastrados projetos desse Político. Clique AQUI e faça sua sugestão.</span>
        <?php } ?>
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


<?php 

get_footer(); 

?>