<?php


add_action( 'add_meta_boxes', 'pol_add_custom_metaboxes' );


function pol_add_custom_metaboxes()
{
    
    // Perfil
    add_meta_box( 'curtiu', 'Curtiram', 'curtiu_display_metabox', 'perfil', 'normal', 'high' );
    add_meta_box( 'naocurtiu', 'Não curtiram', 'naocurtiu_display_metabox', 'perfil', 'normal', 'high' );
    add_meta_box('projetos_debatidos', 'Projetos Debatidos', 'projetos_debatidos_display_metabox','perfil', 'normal', 'high');
    add_meta_box( 'mandato', 'Mandato:', 'mandato_display_metabox', 'perfil', 'normal', 'high' );
    
    // Equipe
    // add_meta_box( 'curtiu', 'Curtiram', 'curtiu_display_metabox', 'equipe', 'normal', 'high' );
    // add_meta_box( 'naocurtiu', 'Não curtiram', 'naocurtiu_display_metabox', 'equipe', 'normal', 'high' );
    
    

    //Projetos
    add_meta_box( 'autoria', 'Autoria do Projeto', 'autoria_display_metabox', 'projeto', 'normal', 'high' );
    add_meta_box( 'data_proposta', 'Data da proposta', 'data_proposta_display_metabox', 'projeto', 'normal', 'high' );
    add_meta_box( 'situacao', 'Situação', 'situacao_display_metabox', 'projeto', 'normal', 'high' );
    add_meta_box( 'justificativa', 'Justificativa', 'justificativa_display_metabox', 'projeto', 'normal', 'high' );
    add_meta_box( 'positivar_projeto', 'Positivaram', 'positivar_projeto_display_metabox', 'projeto', 'normal', 'high' );
    add_meta_box( 'negativar_projeto', 'Negativaram', 'negativar_projeto_display_metabox', 'projeto', 'normal', 'high' );



    //Denúncia
    add_meta_box( 'debate_video', 'DebateGV faz o vídeo?', 'debate_video_display_metabox', 'denuncia', 'normal', 'high' );
    add_meta_box( 'user-personagem', 'Quer ser personagem do vídeo?', 'user_personagem_display_metabox', 'denuncia', 'normal', 'high' );
    add_meta_box( 'local_denuncia', 'Local da denuncia', 'local_denuncia_display_metabox', 'denuncia', 'normal', 'high' );
    add_meta_box( 'obs_bairro', 'Observação (Bairro)', 'obs_bairro_display_metabox', 'denuncia', 'normal', 'high' );
    add_meta_box( 'bairro_denuncia', 'Bairro da denuncia', 'bairro_denuncia_display_metabox', 'denuncia', 'normal', 'high' );
    add_meta_box( 'latitude', 'Latitude', 'latitude_display_metabox', 'denuncia', 'normal', 'high' );
    add_meta_box( 'longitude', 'Longitude', 'longitude_display_metabox', 'denuncia', 'normal', 'high' );
    add_meta_box( 'situacao_denuncia', 'Situacao da denuncia', 'situacao_denuncia_display_metabox', 'denuncia', 'normal', 'high' );
    add_meta_box( 'Autor', 'Autor da Denúncia', 'autor_denuncia_display_metabox', 'denuncia', 'normal', 'high' );
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
  $pol_curtiu = get_post_meta( $post->ID, 'curtiu',true);
  $pol_curtiu = ($pol_curtiu == '') ? array() : $pol_curtiu;
  $n_curtidas = count($pol_curtiu);
  ?>

  <input type="text" name="curtiu" id="curtiu" value="<?php echo $n_curtidas?>" disabled/>

  <?php

  
}

function naocurtiu_display_metabox( $post, $box )
{
    // Busca no banco o link que já foi cadastrado pelo usuário
  $pol_naocurtiu = get_post_meta( $post->ID, 'naocurtiu',true);
  $pol_naocurtiu = ($pol_naocurtiu == '') ? array() : $pol_naocurtiu;
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
  
  <input type="radio" name="situacao" value="tramite" <?php echo ($pol_situacao == 'tramite') ? 'checked':''; ?> >tramite</br>
  <input type="radio" name="situacao" value="vetado" <?php  echo ($pol_situacao == 'vetado') ? 'checked':''; ?>>vetado</br>
  <input type="radio" name="situacao" value="aprovado" <?php echo ($pol_situacao == 'aprovado') ? "checked":''; ?>>aprovado</br>
  <input type="radio" name="situacao" value="arquivado" <?php echo ($pol_situacao == 'arquivado') ? "checked":''; ?>>arquivado</br>
  <?php
  
    ?>
    
    <?php


}


function positivar_projeto_display_metabox( $post, $box )
{
    // Busca no banco o link que já foi cadastrado pelo usuário
  $positivaram = get_post_meta( $post->ID, 'positivar_projeto',true);
  $positivaram = ($positivaram == '') ? array() : $positivaram;
  $qtd_positivo = count($positivaram);
  ?>

  <input type="text" name="curtiu" id="curtiu" value="<?php echo $qtd_positivo?>" disabled/>

  <?php

  
}

function negativar_projeto_display_metabox( $post, $box )
{
    // Busca no banco o link que já foi cadastrado pelo usuário
  $negativaram = get_post_meta( $post->ID, 'negativar_projeto',true);
   $negativaram = ($negativaram == '') ? array() : $negativaram;
  $qtd_negativo = count($negativaram);
  ?>

  <input type="text" name="curtiu" id="curtiu" value="<?php echo $qtd_negativo?>" disabled/>

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


function justificativa_display_metabox($post, $box)
{
  $justificativa = get_post_meta( $post->ID, 'justificativa', true );
  $settings = array('textarea_name' => 'justificativa');

  // wp_editor( $justificativa, 'justificativa', $settings ); 

wp_editor( $justificativa, 'content-id', array( 'textarea_name' => 'justificativa', 'media_buttons' => false, 'tinymce' => array( 'theme_advanced_buttons1' => 'formatselect,forecolor,|,bold,italic,underline,|,bullist,numlist,blockquote,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,|,spellchecker,wp_fullscreen,wp_adv' ) ) ); 


}

function local_denuncia_display_metabox($post, $box)
{
  $local_denuncia = get_post_meta($post->ID, 'local_denuncia', true);
  
?>
  <input type="text" name="local_denuncia" id="local_denuncia" 
  value="<?php echo $local_denuncia; ?>" />
<?php

}

function latitude_display_metabox($post, $box)
{
  $latitude = get_post_meta($post->ID, 'latitude', true);
  
?>
  <input type="text" name="latitude" id="latitude" 
  value="<?php echo $latitude; ?>" />
<?php

}

function longitude_display_metabox($post, $box)
{
  $longitude = get_post_meta($post->ID, 'longitude', true);
  
?>
  <input type="text" name="longitude" id="longitude" 
  value="<?php echo $longitude; ?>" />
<?php

}



function debate_video_display_metabox($post, $box)
{
  $debate_video = get_post_meta($post->ID, 'debate_video', true);
  
?>
  <input type="text" name="debate_video" id="debate_video" 
  value="<?php echo $debate_video; ?>" />
<?php

}

function user_personagem_display_metabox($post, $box)
{
  $user_personagem = get_post_meta($post->ID, 'user-personagem', true);
  
?>
  <input type="text" name="user-personagem" id="user-personagem" 
  value="<?php echo $user_personagem; ?>" />
<?php

}



function situacao_denuncia_display_metabox($post, $box)
{
    $situacao_denuncia = get_post_meta($post->ID, 'situacao_denuncia', true);
  
?>
  <select name="situacao_denuncia" id="situacao_denuncia">
    <option value="nao_resolvida" <?php echo ($situacao_denuncia == 'nao_resolvida') ? "selected" : ""; ?> >Não resolvida</option>
    <option value="resolvida" <?php echo ($situacao_denuncia == 'resolvida') ? "selected" : ""; ?>>Resolvida</option>
  </select>

<?php

}

function bairro_denuncia_display_metabox($post, $box)
{

    $bairro_denuncia = get_post_meta($post->ID, 'bairro_denuncia', true);
    $denuncias = new tromboneController();
    $denuncias->set_bairros_gv();
    $bairros = $denuncias->get_bairros_gv();

  
?>
  <select name="bairro_denuncia" id="bairro_denuncia">
<?php
  var_dump($bairros);
  foreach ($bairros as $bairro) { ?>
      <option value="<?php echo $bairro ?>" <?php echo ($bairro_denuncia == $bairro) ? "selected" : ""; ?>><?php echo $bairro ?></option>
<?php
  }
?>
  </select>

<?php
  
}

function autor_denuncia_display_metabox($post, $box)
{
   $autor = get_userdata( get_the_author_ID() );
    $autor = $autor->user_email;
  
?>
  <input type="text" name="autor" id="autor" 
  value="<?php echo $autor; ?>" />
<?php



}

function obs_bairro_display_metabox($post, $box)
{
     
   $obs_bairro = get_post_meta($post->ID, 'obs_bairro', true);
?>
  <input type="text" name="obs_bairro" id="obs_bairro" 
  value="<?php echo $obs_bairro; ?>" />
<?php
}


?>