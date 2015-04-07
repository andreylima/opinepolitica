<?php
global $wp_query;
$post_id = $wp_query->post->ID;


$projetos = new projetosModel($post_id);

$autor_id = $projetos->getAutor_projeto();
$positivou = $projetos->verifica_positivou();
$negativou = $projetos->verifica_negativou();
$thumbnail_size = 'thumbnail'; //150 x 150

get_header(); 

?>
<div id="single-projeto-wrapper">
  <div class="info-perfil-wrapper coluna-lateral">
  
       <div class="autor-titulo">AUTOR DO PROJETO</div>
    <div class="box-autor">  
     <?php 


     $loop = new WP_Query( array( 'p' => $autor_id,'post_type' => 'perfil') );
   
   while ( $loop->have_posts() ) : $loop->the_post(); 


      $perfis = new perfisController($projetos->getAutor_projeto());
      $curtiu = $perfis->verifica_curtida();
      $naocurtiu = $perfis->verifica_naocurtida();
      $projetos_debatidos = $perfis->get_projetos_debatidos();
     
       ?>

<?php include(locate_template('perfis/view/perfil-wrap.php')); ?> <!-- carrega o template parte do perfil do político -->

<?php endwhile; wp_reset_postdata(); ?>
</div>

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
    <div class="info-perfil">
    <div id="titulo" class="titulo-single-mobile"><?php the_title(); ?></div>
    <span class="total_votos">Total de avaliações: <span class="n_votos"> <?php echo $projetos->get_total_votos() ?></span></span>
    <div class="data-proposta">Proposto em:  <?php echo date('d/m/Y',strtotime(get_post_meta( $post_id, 'data_proposta', true)) ); ?></div>

    <a href="<?php pdf_file_url(); ?>" class="link-projeto-pdf">Baixar projeto</a>
</div>
</div>
<div class="conteudo">
<div class="caixa-titulo">
    
    <div id="titulo" class="titulo-single"><?php the_title(); ?></div>
<div class="fb-like" data-href="<?php echo get_permalink( $post->ID );  ?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
</div>

    
    <div class="panel panel-default debatidos">
  <div class="panel-heading title-projeto-single">SOBRE O PROJETO</div>
      <div class="panel-body">
        <?php 
        $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
        $situacao = get_post_meta( $post->ID, 'situacao',true);
        ?>
        <div class="pic-projeto <?php echo $situacao; ?>" style="background-image: url('<?php echo $url; ?>');">

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
      <div class="panel-heading font-header-small">JUSTIFICATIVA</div>
      <div class="panel-body">
       <?php
          echo get_post_meta( get_the_ID(), 'justificativa', true );
  
          ?>
    </div>
    
    </div>

    
    <div class="form-comment">
    <?php comments_template(); ?>
    </div>
    </div>
  
  </div>

  <?php include(locate_template('modal-template.php')); ?> <!-- carrega o template parte do modal -->

<?php 

get_footer(); 

?>