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
      		<div class="new-fb-btn new-fb-7 new-fb-default-anim"><div class="new-fb-7-1"><div class="new-fb-7-1-1">FACE</div></div></div>
      		<input type="submit" name="login" value="ENTRAR" id="btnentrar-log">
      		</div>
      		<!-- <span class="forgot-pass-header"><a href="">Esqueci a senha</a> </span>  -->
		</span>
	</div>
</div>
	
<div class="projetos-slider-wrapper">

<div class="flicker-example projetos-slider" data-block-text="false">
		
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
      <div class="projeto-excerpt">
      	<?php the_excerpt(); ?>
      	</div>
      	<div class="panel-bottom">
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

      	</div>

    </li>

  <?php endwhile; ?>
			
		</ul>
		
	</div>
	



</div>

<div class="prefeito-wrapper">
	

    <?php $loop = new WP_Query( array( 'post_type' => 'perfil' , 'cargos'=>'prefeito',  'posts_per_page' => 1) ); ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
      <?php 
      $perfis = new perfisModel($post->ID);
      $curtiu = $perfis->verifica_curtida();
      $naocurtiu = $perfis->verifica_naocurtida();

       ?>
      <div class="prefeito perfil">
        <div class="thumb">  
          <a href="<?php echo get_permalink($post->ID); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'img-circle perfil-size')); ?></a> 
          <a href=""><div class="votes pull-left curtir <?php echo ($curtiu) ? "votado" : ""; ?>" id="<?php echo $post->ID; ?>">
            <span class="glyphicon glyphicon-thumbs-up icon-vote">
              
            </span>
            <span class="percent-autor">
            <?php 
            
            echo $perfis->getCurtiu_percent(); 

            ?>
            </span>
          </div>
        </a>
        <a href="">
        <div class="voten pull-right naocurtir <?php echo ($naocurtiu) ? "votado" : ""; ?>" id="<?php echo $post->ID; ?>">
        <span class="glyphicon glyphicon-thumbs-down icon-vote">
          
        </span>
       <span class="percent-autor">
              <?php 
            
            echo $perfis->getNaocurtiu_percent(); 

            ?>
            </span>
        </div>
        </a>
      </div>
      
      <h4 class="name_perfil"><?php the_title() ?></h4>
        <div class="link-perfil"> PERFIL</div>

    </div>

  <?php endwhile; ?>
</div>


<?php get_footer() ?>

