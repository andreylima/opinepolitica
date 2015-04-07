<?php 

get_header(); 

$perfis = new perfisController(get_the_ID());
$curtiu = $perfis->verifica_curtida();
$naocurtiu = $perfis->verifica_naocurtida();
$partidos = wp_get_post_terms( get_the_ID(), 'Partidos',array("fields" => "names"));
$thumbnail_size = 'thumbnail'; //150 x 150
$projetos_debatidos = $perfis->get_projetos_debatidos();
$total_votos = $perfis->get_total_votos();
?>


<div id="single-perfil-wrapper">
  <div class="info-perfil-wrapper">
    <div class="box-perfil coluna-lateral">  

<?php include(locate_template('perfis/view/perfil-wrap.php')); ?> <!-- carrega o template parte do perfil do político -->

</div>
<div class="info-perfil">

<div class="partido">Partido: 
     <?php 
     echo $partidos[0];
     ?>
 </div>
     <span class="mandato">Mandato: <?php echo $perfis->getMandato(); ?></span> 
    <span class='total_votos'>Total de avaliações: <span class='n_votos'> <?php echo $total_votos; ?></span></span>
   
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

<?php include(locate_template('modal-template.php')); ?> <!-- carrega o template parte do modal -->

<?php 

get_footer(); 

?>