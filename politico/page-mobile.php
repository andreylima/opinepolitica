<?php 

get_header('mobile'); 


?>

<?php wp_nav_menu( array( 'theme_location'=>'principal', 'container_id' => 'menu-body' ) ); ?>
<div class="destaque">
<div class="wrap-destaque">
	<h1>OPINE SOBRE OS PROJETOS DE LEI</h1> 
	<h1>PROPOSTOS EM GOVERNADOR VALADARES</h1>
</div>
</div>
<div class="login-wrap">
	<div class="login-field">
		<span class="face-connect">
			</span>
		<span class="login-connect">
			<div >
			<input type="text" name="email" value="email" id="email-log">
      		<input type="password" name="senha" value="senha" id="senha-log">
      		</div>
      		<div class="center-buttons">
      		<div class="new-fb-btn new-fb-7 new-fb-default-anim"><div class="new-fb-7-1"><div class="new-fb-7-1-1">CONNECT</div></div></div>
      		<input type="submit" name="login" value="ENTRAR" id="btnentrar-log">
      		</div>
      		<!-- <span class="forgot-pass-header"><a href="">Esqueci a senha</a> </span>  -->
		</span>
	</div>
</div>
	
<div class="projetos-slider-wraper">

<div class="flicker-example" data-block-text="false">
		
		<ul>
			
									
	<?php $loop = new WP_Query( array( 'post_type' => 'projeto' , 'posts_per_page' => 5, 'orderby'=> 'modified') ); ?>
  <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
  <?php 
      $projeto = new projetosModel(get_the_ID());
      $positivou = $projeto->verifica_positivou();
      $negativou = $projeto->verifica_negativou();

  ?>
    <li class="mini-projeto">
     <div class="panel panel-default">
      <div class="panel-heading"><?php the_title(); ?></div>
      <div class="panel-body">
      	<?php the_excerpt(); ?>
      	<div class="see-more">
      		VEJA MAIS
      	</div>
      	<div class="apoio">
      	<span class="mini-percent-naoapoiaram">
            <span class="glyphicon glyphicon-thumbs-down mini-icon-n"></span>
            <?php echo $projeto->getNegativar_percent(); ?>
            </span>

            <span class="mini-percent-apoiaram">
            <span class="glyphicon glyphicon-thumbs-up mini-icon-s"></span>
            <?php echo $projeto->getPositivar_percent(); ?>
            </span>
		</div>
		</div>

      	</div>

    </li>

  <?php endwhile; ?>
			
		</ul>
		
	</div>
	



</div>


<?php get_footer() ?>

