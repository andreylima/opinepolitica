<?php


add_action( 'add_meta_boxes', 'pol_add_custom_metaboxes' );


function pol_add_custom_metaboxes()
{
    
    // Perfil
    add_meta_box( 'curtiu', 'Curtiram', 'curtiu_display_metabox', 'perfil', 'normal', 'high' );
    add_meta_box( 'naocurtiu', 'Não curtiram', 'naocurtiu_display_metabox', 'perfil', 'normal', 'high' );
    add_meta_box('projetos_debatidos', 'Projetos Debatidos', 'projetos_debatidos_display_metabox','perfil', 'normal', 'high');
    add_meta_box( 'mandato', 'Mandato:', 'mandato_display_metabox', 'perfil', 'normal', 'high' );
    
    

    //Projetos
    add_meta_box( 'autoria', 'Autoria do Projeto', 'autoria_display_metabox', 'projeto', 'normal', 'high' );
    add_meta_box( 'data_proposta', 'Data da proposta', 'data_proposta_display_metabox', 'projeto', 'normal', 'high' );
    add_meta_box( 'situacao', 'Situação', 'situacao_display_metabox', 'projeto', 'normal', 'high' );
    add_meta_box( 'consideracoes', 'Consideracoes do Autor', 'consideracoes_display_metabox', 'projeto', 'normal', 'high' );
    add_meta_box( 'positivar_projeto', 'Positivaram', 'positivar_projeto_display_metabox', 'projeto', 'normal', 'high' );
    add_meta_box( 'negativar_projeto', 'Negativaram', 'negativar_projeto_display_metabox', 'projeto', 'normal', 'high' );


}

/**
  * Realiza a marcação HTML do metabox
  * 
  * @param object $post 
  * @param type $box 
  * @return void
  */ 
function quem_perguntou_display_metabox($post, $box)
{
  $pol_quem_perguntou_id = get_post_meta($post->ID, 'quem_perguntou', true);
  $pol_quem_perguntou = get_userdata( $pol_quem_perguntou_id );
?>
  <input type="text" name="quem_perguntou" id="quem_perguntou" 
  value="<?php echo $pol_quem_perguntou->first_name.' '.$pol_quem_perguntou->last_name; ?>" disabled/>
<?php
}

function autoria_display_metabox( $post, $box){


  $pol_autoria = get_post_meta( $post->ID, 'autoria', true );

  $args = array('post_type' => 'perfil', 'posts_per_page'=>'-1');
  $loop = new WP_Query( $args );

  while ( $loop->have_posts() ) : $loop->the_post();
   ?>
  <input type="radio" name="autoria" value="<?php echo the_id() ?>"   required
  <?php 
  $nome_politico = get_the_id(); 
  if ( $pol_autoria == $nome_politico ) {
    echo "checked";
  }

  ?>

  > 
  <?php echo the_title() ?> <br>

  <?php

  endwhile;


}

function curtiu_display_metabox( $post, $box )
{
    // Busca no banco o link que já foi cadastrado pelo usuário
  $pol_curtiu = get_user_meta( get_current_user_id(), 'curtiu');
  $n_curtidas = count($pol_curtiu);
  ?>

  <input type="text" name="curtiu" id="curtiu" value="<?php echo $n_curtidas?>" disabled/>

  <?php

  
}

function naocurtiu_display_metabox( $post, $box )
{
    // Busca no banco o link que já foi cadastrado pelo usuário
  $pol_naocurtiu = get_user_meta( get_current_user_id(), 'naocurtiu');
  $n_ncurtidas = count($pol_naocurtiu);

  ?>

  <input type="text" name="naocurtiu" id="naocurtiu" value="<?php echo $n_ncurtidas; ?>" disabled/>

  <?php

  
}


function data_proposta_display_metabox( $post, $box)  
{

  $pol_data_proposta = get_post_meta( $post->ID, 'data_proposta', true );

  ?>

  <input type="date" name="data_proposta" id="data_proposta" value="<?php echo $pol_data_proposta; ?>" required/>

  <?php

}

function situacao_display_metabox($post, $box)
{

  $pol_situacao = get_post_meta( $post->ID, 'situacao', true );
  ?>
  
  <input type="text" name="situacao" id="situacao" value="<?php echo $pol_situacao; ?>" />

  <?php
  
    ?>
    
    <?php


}


function positivar_projeto_display_metabox( $post, $box )
{
    // Busca no banco o link que já foi cadastrado pelo usuário
  $positivaram = get_user_meta( get_current_user_id(), 'positivar_projeto');
  $qtd_positivo = count(array_filter($positivaram));
  ?>

  <input type="text" name="curtiu" id="curtiu" value="<?php echo $qtd_positivo?>" disabled/>

  <?php

  
}

function negativar_projeto_display_metabox( $post, $box )
{
    // Busca no banco o link que já foi cadastrado pelo usuário
  $negativaram = get_user_meta( get_current_user_id(), 'negativar_projeto');
  $qtd_positivo = count(array_filter($negativaram));
  ?>

  <input type="text" name="curtiu" id="curtiu" value="<?php echo $qtd_positivo?>" disabled/>

  <?php

  
}


function mandato_display_metabox($post, $box)
{

$mandato = get_post_meta( $post->ID, 'mandato', true );


  ?>
  
  <label for="mandato_inicio"> Em qual mandato o vereador está:  </label>
  <input type="text" name="mandato" id="mandato" value="<?php echo $mandato; ?>" required/>
  


  <?php

}

function projetos_debatidos_display_metabox($post, $box)
{
    $projetos_debatidos = get_post_meta( $post->ID, 'projetos_debatidos', true );
    
    if (!empty($projetos_debatidos)) {
      foreach ($projetos_debatidos as $projeto) {
        $projetos[] = get_the_title($projeto); 
        $projetos_debatidos = implode(', ', $projetos);
      }

       
    }
    else
    {
      $projetos_debatidos = "";
    }
   

  ?>
  <textarea rows="4" cols="55" name="resposta_responsavel" id="resposta_responsavel"><?php echo $projetos_debatidos; ?>
  </textarea>
  
  <?php
}


function consideracoes_display_metabox($post, $box)
{
  $consideracoes = get_post_meta( $post->ID, 'consideracoes', true );


  ?>
  
  <label for="consideracoes">CONSIDERAÇÕES DO AUTOR</label>
  <textarea rows="3" cols="55" name="consideracoes" id="consideracoes"><?php echo $consideracoes; ?></textarea>
  


  <?php


}

?>