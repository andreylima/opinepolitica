<?php


class tromboneController {

	
private $denuncia_completa;




	public function __construct()
	{
		
		$this->setDenuncia_completa();

	}


	public function setDenuncia_completa()
	{

		
		$loop = new WP_Query( array( 'post_type' => 'denuncia' ) ); 

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



}

?>