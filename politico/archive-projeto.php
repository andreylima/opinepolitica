<?php 

get_header();



?>

<div id="archive-wrapper">

  <div class="title-panel text-center big-header">
    <h2>Conheça cada Projeto, dê a sua opinião,</h2> 
    <h2>e mostre que estamos de olho!</h2>
  </div>

  <div class="title-panel text-center small-header">
    <h4>Conheça cada Projeto,</h4> 
    <h4>dê a sua opinião,</h4> 
    <h4>e mostre que estamos de olho!</h4>
  </div>
<?php get_search_form(); ?>

<div class="filtro-projetos">
<!-- filtro de autores dos projetos -->

<select data-filter-group="autores" data-placeholder="Escolha um Vereador..." class="chosen-select-author chosen-select" style="width:350px;" tabindex="2">
<option data-filter="" value="*">Escolha um Vereador...</option>
<option data-filter="" value="*">Todos</option>
    <?php $loop = new WP_Query( array( 'post_type' => 'perfil','posts_per_page' => 100 ) ); 

   while ( $loop->have_posts() ) : $loop->the_post(); 

   ?>
  
  <option data-filter=".<?php echo the_ID(); ?>" value="<?php echo the_ID(); ?>"><?php echo the_title(); ?></option>


  <?php endwhile; wp_reset_postdata(); ?>      
            
  </select>

<!-- filtro de partidos dos autores -->

<select data-filter-group="partidos" data-placeholder="Partidos" class="chosen-select-partido chosen-select" style="width:350px;" tabindex="2">
<option data-filter="" value="*">Partidos</option>
<option data-filter="" value="*">Todos</option>
    <?php 

    $partidos = get_terms('Partidos');

     foreach ( $partidos as $partido ) {
         
   ?>
 
  <option data-filter=".<?php echo $partido->name; ?>" value="<?php echo $partido->name; ?>"><?php echo $partido->name; ?></option>

  <?php } ?>
            
  </select>

<!-- filtro de situação dos projetos dos autores -->

<select data-filter-group="situacao" data-placeholder="Situação" class="chosen-select-situacao chosen-select" style="width:350px;" tabindex="2">
<option data-filter="" value="*">Situação</option>
<option data-filter="" value="*">Todos</option>
<option data-filter=".projeto-aprovado" value="projeto-aprovado">Aprovado</option>
<option data-filter=".projeto-arquivado" value="projeto-arquivado">Arquivado</option>  
<option data-filter=".projeto-tramite" value="projeto-tramite">em Trâmite</option>  
<option data-filter=".projeto-vetado" value="projeto-vetado">Vetado</option>         
</select>

</div>



<div class="todos-projetos container" id="container">
	
<?php $loop = new WP_Query( array( 'post_type' => 'projeto' , 'posts_per_page' => -1) ); 

 while ( $loop->have_posts() ) : $loop->the_post(); 

$projetos = new projetosModel($post->ID);
$autor_id = $projetos->getAutor_projeto();
$sigla = $projetos->get_partido();
$situacao = get_post_meta( $post->ID, 'situacao',true); 
$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
$total_comments = get_comments_number( $post->ID );
$is_mini = true; //exibido pequeno ou grande
$show_comments = true;//se true mostra os comentários no projeto

// Pega comentários de um post específico
$comments = get_comments(array(
  'number' => '3',
  'post_id' =>  $post->ID,
  'status' => 'approve' //Change this to the type of comments to be displayed
  ));

?>
         
<?php include(locate_template('projetos/view/projeto-wrap.php')); ?> <!-- carrega o template parte do projeto -->


<?php endwhile; ?>


</div>




</div>

<?php include(locate_template('modal-template.php')); ?> <!-- carrega o template parte do modal -->


<?php get_footer() ?>