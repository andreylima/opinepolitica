<?php


class tromboneController {

	
private $denuncia_completa;

private $bairros_gv;

private $bairros_denuncia;

private $qtd_denuncias;

private $qtd_denuncia_resolvida;

private $percent_resolvidas;

	public function __construct()
	{
		
		$this->setDenuncia_completa();
		$this->set_qtd_denuncias();
		$this->set_qtd_resolvidas();
		$this->set_percent_resolvidas();
	}


	public function setDenuncia_completa()
	{

		
		$loop = new WP_Query( array( 'post_type' => 'denuncia', 'oderby' => 'date' ) ); 

		$i = 0;


		if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); 

		$denuncia_completa[$i]['titulo'] = get_the_title();
		$denuncia_completa[$i]['id'] = get_the_id();
		$denuncia_completa[$i]['link_video'] = get_post_meta(get_the_id(), 'link_video', true );
		$denuncia_completa[$i]['local_denuncia'] = get_post_meta(get_the_id(), 'local_denuncia', true  );
		$denuncia_completa[$i]['latitude'] = get_post_meta(get_the_id(), 'latitude' , true );
		$denuncia_completa[$i]['longitude'] = get_post_meta(get_the_id(), 'longitude', true  );
		$denuncia_completa[$i]['data'] = get_the_date();
		$denuncia_completa[$i]['permalink'] = get_the_permalink();
		$denuncia_completa[$i]['situacao_denuncia'] = get_post_meta(get_the_id(), 'situacao_denuncia', true  );
		$denuncia_completa[$i]['qtd_comments_denuncia'] = get_comments_number( get_the_id() );
		$denuncia_completa[$i]['bairro_denuncia'] = get_post_meta(get_the_id(), 'bairro_denuncia', true );


		$i += 1;
 		endwhile; endif; 


		wp_reset_postdata();


		$denuncia_completa = ($denuncia_completa == '') ? array() : $denuncia_completa;
		$this->denuncia_completa = $denuncia_completa;

		
	
	}


	public function getDenuncia_completa()
	{

		return $this->denuncia_completa;

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
		$bairros_denuncia = $wpdb->get_col("SELECT meta_value
		FROM $wpdb->postmeta WHERE meta_key = 'bairro_denuncia'" );

		$this->bairros_denuncia = array_count_values( $bairros_denuncia );


	}


	public function get_count_bairros()
	{

		return $this->bairros_denuncia;
	}


	public function set_qtd_denuncias()
	{
		$posts = wp_count_posts( 'denuncia' );
		$this->qtd_denuncias = $posts->publish;


	}

	public function get_qtd_denuncias()
	{
		return $this->qtd_denuncias;
	}

	public function set_qtd_resolvidas()
	{
		global $wpdb;
		$this->qtd_denuncia_resolvida = $wpdb->get_var( "SELECT count(DISTINCT pm.post_id)
														FROM $wpdb->postmeta pm
														JOIN $wpdb->posts p ON (p.ID = pm.post_id)
														WHERE pm.meta_key = 'situacao_denuncia'
														AND pm.meta_value = 'resolvida'
														AND p.post_type = 'denuncia'
														AND p.post_status = 'publish'
														" );


	}


	public function get_qtd_resolvidas()
	{
		return $this->qtd_denuncia_resolvida;

	}



	public function set_percent_resolvidas()
	{
		$total = $this->get_qtd_denuncias();

		$resolvidas = $this->get_qtd_resolvidas();

		$this->percent_resolvidas =  round($resolvidas / $total * 100, 2)."%"; 


	}


	public function get_percent_resolvidas()
	{

		return $this->percent_resolvidas;

	}

	public function save_denuncia_wp($denuncia)
	{

		$my_post = array(
		  'post_title'    => $denuncia['denuncia_title'],
		  'post_content'  => $denuncia['descricao_denuncia'],
		  'post_status'   => 'pending',
		  'post_type' => 'denuncia',

		);


		$postID = wp_insert_post( $my_post );


		return $postID;



	}







}

?>