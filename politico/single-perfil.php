<?php 

get_header('inside'); 

$perfis = new perfisModel(get_the_ID());
$curtiu = $perfis->verifica_curtida();
$naocurtiu = $perfis->verifica_naocurtida();
$partidos = wp_get_post_terms( get_the_ID(), 'Partidos',array("fields" => "names"));

?>


<div class="single-wrapper">
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
    <h4><?php  echo $projetos_debatidos; ?> Projetos Cadastrados</h4>

</div>
</div>
<div class="caixa-titulo-politico">
    <div class="partido">
     <?php 
     echo $partidos[0];
     ?>
 </div>

 <div id="titulo" class="titulo-perfil"><?php the_title(); ?></div>
 <span id="mandato" class="mandato">
    <label for="n_mandato" id="label_n_mandato">Mandato:</label>
    <div class="n_mandato"><?php echo $perfis->getMandato(); ?></div> 
</span>


<div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>

</div>



<div class="conteudo panel panel-default debatidos">
  <div class="panel-heading title-projeto-single">PERFIL</div>
  <div class="panel-body">
    <?php while ( have_posts() ) : the_post();

    the_content();

    endwhile;
    ?>




</div>
</div>



<div class="conteudo panel panel-default debatidos">
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
                <div class="panel-heading mini-projeto-header"><?php echo $projeto_dados->post_title; ?></div>
                <div class="panel-body">
                    <div class="pic-projeto" style="background-image: url('http://www.apostasfc.com/blog/wp-content/uploads/2014/05/apostas-desportivas_Portugal_TVI_maisfutebol_Aposta-X.jpg');">

                    </div>      
                    <div class="projeto-excerpt">
                        <?php echo $projeto_dados->post_excerpt; ?>
                    </div>
                    <div class="panel-bottom">
                        <a href="<?php echo $permalink; ?>">
                            <div class="see-more">
                                SAIBA MAIS
                            </div>
                        </a>
                        <div class="percent-wrapper">
                        <span class="mini-percent-naoapoiaram">
                            <span class="glyphicon glyphicon-thumbs-down mini-icon-n"></span>
                            <?php echo $projetos->getNegativar_percent(); ?>
                        </span>

                        <span class="mini-percent-apoiaram">
                            <span class="glyphicon glyphicon-thumbs-up mini-icon-s"></span>
                            <?php echo $projetos->getPositivar_percent(); ?>
                        </span>
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




<?php 

get_footer(); 

?>