<?php


class tromboneController {


private $reclamacao_completa;

private $bairros_gv;

private $bairros_reclamacao;

private $qtd_reclamacoes;

private $qtd_reclamacao_resolvida;

private $percent_resolvidas;

private $reclamacao_single;

	public function __construct()
	{

		$this->setreclamacao_completa();
		$this->set_qtd_reclamacoes();
		$this->set_qtd_resolvidas();
		$this->set_percent_resolvidas();
	}


	public function setreclamacao_completa()
	{


		$loop = new WP_Query( array( 'post_type' => 'reclamacao', 'oderby' => 'date',  'post_status'=>'publish' ) );

		$i = 0;


		if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();

		$reclamacao_completa[$i]['titulo'] = get_the_title();
		$reclamacao_completa[$i]['id'] = get_the_id();
		$reclamacao_completa[$i]['local_reclamacao'] = get_post_meta(get_the_id(), 'local_reclamacao', true  );
		$reclamacao_completa[$i]['latitude'] = get_post_meta(get_the_id(), 'latitude' , true );
		$reclamacao_completa[$i]['longitude'] = get_post_meta(get_the_id(), 'longitude', true  );
		$reclamacao_completa[$i]['data'] = get_the_date();
		$reclamacao_completa[$i]['permalink'] = get_the_permalink();
		$reclamacao_completa[$i]['situacao_reclamacao'] = get_post_meta(get_the_id(), 'situacao_reclamacao', true  );
		$reclamacao_completa[$i]['qtd_comments_reclamacao'] = get_comments_number( get_the_id() );
		$reclamacao_completa[$i]['bairro_reclamacao'] = get_post_meta(get_the_id(), 'bairro_reclamacao', true );
		$reclamacao_completa[$i]['link_imagem'] = wp_get_attachment_thumb_url( get_post_thumbnail_id( $post_id ) );

		$i += 1;
 		endwhile; endif;


		wp_reset_postdata();


		$reclamacao_completa = ($reclamacao_completa == '') ? array() : $reclamacao_completa;
		$this->reclamacao_completa = $reclamacao_completa;



	}


	public function get_reclamacao_completa()
	{

		return $this->reclamacao_completa;

	}

	public function set_bairros_gv()
	{

		$bairros_gv = array('Centro','Esplanada','São Tarcísio','Capim','Cardo','Sir','Floresta','Interlagos','Sion',
							'Recanto das Garças','Alto Esplanada','Belvedere','São Pedro','Universitário','Santos Dumont',
							'Santos Dumont II','Chácaras Braúnas','Jother Peres','Sítio das Flores','Vila Mariquita',
							'Santa Helena','Monte Carmelo','Cidade Nova','Lagoa Santa','Maria Eugênia','Santa Rosa de Lima',
							'Esperança','Morada do Vale','Morada do Vale II','Morada do Vale III','Grã-Duquesa','Santo Agostinho',
							'Vale Verde','Carapina','Nossa Senhora das Graças','Santa Efigênia','Querosene','Ilha dos Araújos',
							'Lourdes','Santa Terezinha','Acampamento da Vale','Vila Mariana','São Geraldo','Altinópolis','Mãe de Deus',
							'São Braz','Santo Antônio','Maravilha','Vista Alegre','Planalto','Borges','Jardim do Trevo','Santa Paula',
							'Jardim Primavera','Vila Parque Ibituruna','Vila Parque São João','Recanto das Cachoeiras','São Paulo',
							'Vila Bretas','São Raimundo','Vila Isa','Jardim Ipê','Vera Cruz','Jardim Atalaia','Asteca','Jardim Alvorada',
							'Vale Primavera','Betel','Distrito Industrial','Castanheiras','Jardim Alice','JK I','JK II','JK III','Santa Rosa',
							'Santa Rita','Nova Santa Rita','Canaã','Vale Pastoril','Vale Pastoril II','Turmalina','Sagrada Família','Vila União',
							'Penha','Novo Horizonte','Vila Império','São Cristóvão','Senhora de Fátima','Vila Ozanan','Palmeiras','Redenção',
							 'Nova Vila Bretas', 'Bela Vista','Retiro dos Lagos','Kennedy','Jardim Pérola','Fraternidade','Vila Rica', 'São José',
							 'Elvamar','Vilagge da Serra','Parque das Aroeiras','Encosta do Sol');



		$this->bairros_gv = $bairros_gv;




	}

	public function get_bairros_gv()
	{

		return $this->bairros_gv;

	}



	public function set_count_bairros()
	{
		$bairros_reclamacao = $wpdb->get_col("SELECT meta_value
		FROM $wpdb->postmeta WHERE meta_key = 'bairro_reclamacao'" );

		$this->bairros_reclamacao = array_count_values( $bairros_reclamacao );


	}


	public function get_count_bairros()
	{

		return $this->bairros_reclamacao;
	}


	public function set_qtd_reclamacoes()
	{
		$posts = wp_count_posts( 'reclamacao' );
		$this->qtd_reclamacoes = $posts->publish;


	}

	public function get_qtd_reclamacoes()
	{
		return $this->qtd_reclamacoes;
	}

	public function set_qtd_resolvidas()
	{
		global $wpdb;
		$this->qtd_reclamacao_resolvida = $wpdb->get_var( "SELECT count(DISTINCT pm.post_id)
														FROM $wpdb->postmeta pm
														JOIN $wpdb->posts p ON (p.ID = pm.post_id)
														WHERE pm.meta_key = 'situacao_reclamacao'
														AND pm.meta_value = 'resolvida'
														AND p.post_type = 'reclamacao'
														AND p.post_status = 'publish'
														" );


	}


	public function get_qtd_resolvidas()
	{
		return $this->qtd_reclamacao_resolvida;

	}



	public function set_percent_resolvidas()
	{
		$total = $this->get_qtd_reclamacoes();

		$resolvidas = $this->get_qtd_resolvidas();

		if ($total == 0) {
			$this->percent_resolvidas = 0;
		}
		else
		{

			$this->percent_resolvidas =  round($resolvidas / $total * 100, 2)."%";
		}




	}


	public function get_percent_resolvidas()
	{

		return $this->percent_resolvidas;

	}

	public function save_reclamacao_wp($reclamacao)
	{


		$my_post = array(
		  'post_title'    => $reclamacao['reclamacao_title'],
		  'post_content'  => $reclamacao['descricao_reclamacao'],
		  'post_status'   => 'pending',
		  'post_type' => 'reclamacao',

		);


		$postID = wp_insert_post( $my_post );
		global $current_user;
		get_currentuserinfo();

		update_post_meta( $postID, 'local_reclamacao', $reclamacao['endereco']);
		update_post_meta( $postID, 'obs_bairro', $reclamacao['obs-bairro']);
		update_post_meta( $postID, 'longitude', $reclamacao['longitude']);
		update_post_meta( $postID, 'latitude', $reclamacao['latitude']);
		update_post_meta( $postID, 'autor-email', $current_user->user_email);

		$filename = $_FILES['file']['name'];
		$uploaddir = wp_upload_dir();
		$uploadfile = $uploaddir['path'] . '/' . $filename;
		move_uploaded_file( $_FILES['file']['tmp_name'] , $uploadfile );

		$wp_filetype = wp_check_filetype(basename($filename), null );

		 $attachment = array(
		      'guid'           => $uploaddir['url'] . '/' . basename( $filename ),
		      'post_mime_type' => $wp_filetype['type'],
		      'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
		      'post_content' => '',
		      'post_status' => 'inherit',
		      'menu_order' => $_i + 1000
		  );
		  $attach_id = wp_insert_attachment( $attachment, $uploadfile, $postID );

		  update_post_meta($postID,'thumbnail_id',$attach_id);

		  set_post_thumbnail( $postID, $attach_id );


		send_email_reclamacao();

		return $postID;



	}

	public function set_reclamacao_single()
	{

		$reclamacao_single[0]['titulo'] = get_the_title();
		$reclamacao_single[0]['id'] = get_the_id();
		$reclamacao_single[0]['local_reclamacao'] = get_post_meta(get_the_id(), 'local_reclamacao', true  );
		$reclamacao_single[0]['latitude'] = get_post_meta(get_the_id(), 'latitude' , true );
		$reclamacao_single[0]['longitude'] = get_post_meta(get_the_id(), 'longitude', true  );
		$reclamacao_single[0]['data'] = get_post_meta(get_the_id(), 'data-reclamacao', true  );
		$reclamacao_single[0]['permalink'] = get_the_permalink();
		$reclamacao_single[0]['situacao_reclamacao'] = get_post_meta(get_the_id(), 'situacao_reclamacao', true  );
		$reclamacao_single[0]['qtd_comments_reclamacao'] = get_comments_number( get_the_id() );
		$reclamacao_single[0]['bairro_reclamacao'] = get_post_meta(get_the_id(), 'bairro_reclamacao', true );


		$this->reclamacao_single = $reclamacao_single;

	}

	public function get_reclamacao_single()
	{

		return $this->reclamacao_single;

	}




}

?>