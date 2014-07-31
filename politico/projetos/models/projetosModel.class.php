<?php

class projetosModel {
	
	private $ID;

	private $autor_projeto;

	private $total_votos;
	
	public function __construct($post_id)
	{
		
		
		$this->ID = $post_id;
		$this->setAutor_projeto();
		$this->setPositivar_percent();
		$this->setNegativar_percent();
		$this->set_total_votos();

	}

	
	public function setAutor_projeto() {


		$id_autor = get_post_meta($this->ID, 'autoria',true);

	
		$this->autor_projeto = $id_autor;	


	}

	public function getAutor_projeto()
	{

		return $this->autor_projeto;
	}




	public function positivar_projeto()
	{
		


		$array_positivo = get_post_meta($this->ID , 'positivar_projeto', true);
		$array_negativo = get_post_meta($this->ID , 'negativar_projeto', true);
		
		
		if (!empty($array_negativo)) {

			if (in_array(get_current_user_id() , $array_negativo)) {
				
				$indice = array_search(get_current_user_id(), $array_negativo);
				unset( $array_negativo[$indice] );
				
				update_post_meta( $this->ID, 'negativar_projeto', $array_negativo);

				}
		}

		

		if (!empty($array_positivo)) {

			if (!in_array(get_current_user_id() , $array_positivo)) {
			$array_positivo[] = get_current_user_id();
			update_post_meta( $this->ID, 'positivar_projeto', $array_positivo );
				}

		}
		else
		{
			$array_positivo[] = get_current_user_id();
			update_post_meta( $this->ID, 'positivar_projeto', $array_positivo );

		}
		
		
		return true;
		exit;
	}

	public function negativar_projeto()
	{
		
		$array_negativo = get_post_meta($this->ID , 'negativar_projeto', true);		
		$array_positivo = get_post_meta($this->ID, 'positivar_projeto', true);
		
		
		
		if (!empty($array_positivo)) {

			if (in_array(get_current_user_id() , $array_positivo)) {
				
				$indice = array_search(get_current_user_id(), $array_positivo);
				unset( $array_positivo[$indice] );
				
				update_post_meta( $this->ID, 'positivar_projeto', $array_positivo);

				}
		}

		

		if (!empty($array_positivo)) {

			if (!in_array($this->user_id , $array_positivo)) {
			$array_positivo[] = get_current_user_id();
			update_post_meta( $this->ID, 'negativar_projeto', $array_positivo );
				}

		}
		else
		{
			$array_positivo[] = get_current_user_id();
			update_post_meta( $this->ID, 'negativar_projeto', $array_positivo );

		}
		
		
		return true;
		exit;
	}

	public function setPositivar_percent()
	{

		
		$array_positivou = get_post_meta($this->ID, 'positivar_projeto');
		$array_negativou = get_post_meta($this->ID, 'negativar_projeto');

		$array_positivou = ($array_positivou == '') ? array() : $array_positivou;
		$array_negativou = ($array_negativou == '') ? array() : $array_negativou;


		$total_votos = count(array_filter($array_positivou)) + count(array_filter($array_negativou));
		
		if ($total_votos != 0) {
			$this->positivarPercent = round(count(array_filter($array_positivou)) / $total_votos * 100)."%";

		}
		else
		{
			$this->positivarPercent = "0%";
		}
		
		
	}

	public function getPositivar_percent()
	{

		return $this->positivarPercent;

	}
		public function setNegativar_percent()
	{

		
		$array_positivou = get_post_meta($this->ID, 'positivar_projeto');
		$array_negativou = get_post_meta($this->ID, 'negativar_projeto');

		$array_positivou = ($array_positivou == '') ? array() : $array_positivou;
		$array_negativou = ($array_negativou == '') ? array() : $array_negativou;


		$total_votos = count(array_filter($array_positivou)) + count(array_filter($array_negativou));
		
		if ($total_votos != 0) {
			$this->negativarPercent = round(count(array_filter($array_negativou)) / $total_votos * 100)."%";

		}
		else
		{
			$this->negativarPercent = "0%";
		}
		
		
	}

	public function getNegativar_percent()
	{

		return $this->negativarPercent;

	}

	public function verifica_positivou()
	{
		$array_positivou = get_post_meta($this->ID, 'positivar_projeto',true);
		$array_positivou = ($array_positivou == '') ? array() : $array_positivou;

		if (in_array(get_current_user_id(), $array_positivou))
		{
			return true;
			exit();
		}

		return false;

	}
	public function verifica_negativou()
	{
		$array_negativou = get_post_meta($this->ID, 'negativar_projeto',true);
		$array_negativou = ($array_negativou == '') ? array() : $array_negativou;

		if (in_array(get_current_user_id(), $array_negativou))
		{
			return true;
			exit();
		}

		return false;

	}

	public function set_total_votos()
	{
		$array_positivou = get_post_meta($this->ID, 'positivar_projeto',true);
		$array_negativou = get_post_meta($this->ID, 'negativar_projeto',true);

		$array_positivou = ($array_positivou == '') ? array() : $array_positivou;
		$array_negativou = ($array_negativou == '') ? array() : $array_negativou;


		$total_votos = count(array_filter($array_positivou)) + count(array_filter($array_negativou));

			$this->total_votos =  $total_votos;
	}


	public function get_total_votos()
	{
		return $this->total_votos;
	}



}


?>