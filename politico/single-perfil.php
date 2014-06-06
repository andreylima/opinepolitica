<?php 

get_header('inside'); 

$perfis = new perfisModel(get_the_ID());
$curtiu = $perfis->verifica_curtida();
$naocurtiu = $perfis->verifica_naocurtida();
$partidos = wp_get_post_terms( get_the_ID(), 'Partidos',array("fields" => "names"));

?>


<div class="row-fluid">
  
    <div class="box-autor coluna-lateral">  
      
        <?php  echo get_the_post_thumbnail( get_the_ID(), array('class' =>'null perfil-size img-circle')); ?>
        <a href=""><div class="votes pull-left curtir <?php echo ($curtiu) ? "votado" : ""; ?>" id="<?php echo get_the_ID() ?>">
            <span class="glyphicon glyphicon-thumbs-up icon-vote">
            
              
            </span>
            <span class="percent-autor">
            <?php echo $perfis->getCurtiu_percent(); ?>
            </span>
        </div>
    </a>
    <a href="">
        <div class="voten pull-right naocurtir <?php echo ($naocurtiu) ? "votado" : ""; ?>" id="<?php echo get_the_ID() ?>">
            <span class="glyphicon glyphicon-thumbs-down icon-vote">
        
            </span>
            <span class="percent-autor">
            <?php echo $perfis->getNaocurtiu_percent(); ?>
            </span>
        </div>
    </a>
</div>

<div class="caixa-titulo-projeto">
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
      <div class="panel-heading">PERFIL</div>
      <div class="panel-body">
        <?php
       while ( have_posts() ) : the_post();
       the_content();
       endwhile;
        ?></div>
  </div>

    <div class="conteudo panel panel-default debatidos">
      <div class="panel-heading">PROJETOS DEBATIDOS</div>
      <div class="panel-body">
        <?php 
        $projetos_debatidos = get_post_meta( get_the_ID(), 'projetos_debatidos', true );

        foreach ($projetos_debatidos as $projeto) {
            $projeto_dados = get_post($projeto);
            $projetos = new projetosModel($projeto_dados->ID);

        ?>
        <a href="<?php echo get_permalink($projeto_dados->ID); ?>">
        <div class="panel panel-default mini-projeto">
            <div class="panel-heading mini-projeto-header"><div class="mini-projeto-titulo"><?php echo $projeto_dados->post_title; ?></div>
            
            <span class="mini-percent-naoapoiaram">
            <span class="glyphicon glyphicon-thumbs-down mini-icon-n"></span>
            <?php echo $projetos->getNegativar_percent(); ?>
            </span>

            <span class="mini-percent-apoiaram">
            <span class="glyphicon glyphicon-thumbs-up mini-icon-s"></span>
            <?php echo $projetos->getPositivar_percent(); ?>
            </span>
            
            </div>
            <div class="panel-body"><?php echo $projeto_dados->post_excerpt; ?></div>

            
        </div>
        </a>
        <?php } ?>

    </div>
    </div>







<?php 

get_footer(); 

?>