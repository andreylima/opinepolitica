<?php 

get_header();

global $post;


?>



<div id="archive-wrapper">

  <div class="title-panel text-center big-header">
    <h2>Avalie os Poderes Executivo e Legislativo</h2> 
    <h2>de Governador Valadares</h2>
  </div>

  <div class="title-panel text-center small-header">
    <h2>Avalie os Poderes Executivo e Legislativo</h2> 
    <h2>de Governador Valadares</h2>
  </div>
<?php get_search_form(); ?>

<div class="filtro-perfis">

 <!-- filtro cargos -->
<select data-filter-group="cargos" data-placeholder="Cargos" class="chosen-select-cargo chosen-select" style="width:350px;" tabindex="2">
<option data-filter="" value="*">Cargos</option>
<option data-filter="" value="*">Todos</option>
    <?php 

    $cargos = get_terms('Cargos');

     foreach ( $cargos as $cargo ) {
       
   ?>
 
  <option data-filter=".<?php echo $cargo->name; ?>" value="<?php echo $cargo->name; ?>"><?php echo $cargo->name; ?></option>

  <?php } ?>
            
  </select>


<!-- filtro de partidos dos perfis -->

<select data-filter-group="perfis" data-placeholder="Partidos" class="chosen-select-partido chosen-select" style="width:350px;" tabindex="2">
<option data-filter="" value="*">Partidos</option>
<option data-filter="" value="*">Todos</option>
    <?php 

    $partidos = get_terms('Partidos');

     foreach ( $partidos as $partido ) {
         
   ?>
 
  <option data-filter=".<?php echo $partido->name; ?>" value="<?php echo $partido->name; ?>"><?php echo $partido->name; ?></option>

  <?php } ?>
            
  </select>

<!-- filtro de gênero dos perfis -->

<select data-filter-group="perfis" data-placeholder="Gênero" class="chosen-select-genero chosen-select" style="width:350px;" tabindex="2">
<option data-filter="" value="*">Gênero</option>
<option data-filter="" value="*">Todos</option>
    <?php 

    $generos = get_terms('Genero');

     foreach ( $generos as $genero ) {
         
   ?>
 
  <option data-filter=".<?php echo $genero->name; ?>" value="<?php echo $genero->name; ?>"><?php echo $genero->name; ?></option>

  <?php } ?>
            
  </select>
 

</div>


  <div class="perfis" id="perfis">

    <?php $loop = new WP_Query( array( 'post_type' => 'perfil' , 'cargos'=>'executivo',  'posts_per_page' => 1) ); 
$thumbnail_size = 'thumbnail'; //150 x 150
   while ( $loop->have_posts() ) : $loop->the_post(); 


      $perfis = new perfisController($post->ID);
      $curtiu = $perfis->verifica_curtida();
      $naocurtiu = $perfis->verifica_naocurtida();
      $projetos_debatidos = $perfis->get_projetos_debatidos();
      $cargo = $perfis->get_cargo();
      $partido = $perfis->get_partido();
      $genero = $perfis->get_genero();
      
     

       ?>
      <div class="prefeito perfil <?php echo $cargo.'  '.$partido.'  '.$genero; ?>">
      
      <?php include(locate_template('perfis/view/perfil-wrap.php')); ?> <!-- carrega o template parte do perfil do político -->

    </div>
  
  <?php endwhile; wp_reset_postdata();

  $loop = new WP_Query( array( 'post_type' => 'perfil' , 'cargos'=>'Vereador',  'posts_per_page' => 100, 'orderby'=> 'title', 'order' => 'asc') );
  $thumbnail_size = 'thumbnail'; //150 x 150
  while ( $loop->have_posts() ) : $loop->the_post(); 

      $perfis = new perfisController($post->ID);
      $curtiu = $perfis->verifica_curtida();
      $naocurtiu = $perfis->verifica_naocurtida();
      $projetos_debatidos = $perfis->get_projetos_debatidos(); 
      $cargo = $perfis->get_cargo();
      $partido = $perfis->get_partido();
      $genero = $perfis->get_genero();


  ?>
  
  <div class="vereador perfil <?php echo $cargo.'  '.$partido.'  '.$genero; ?>">

<?php include(locate_template('perfis/view/perfil-wrap.php')); ?> <!-- carrega o template parte do perfil do político -->

  </div>
  

  <?php endwhile; wp_reset_postdata();?>

</div>



</div>

<?php include(locate_template('modal-template.php')); ?> <!-- carrega o template parte do modal -->



<?php get_footer() ?>