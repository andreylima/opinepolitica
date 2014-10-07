<?php
 



class perfisController {
	

	private $curtiu_percent;

	private $naocurtiu_percent;
	
	private $perfil_id;

	private $votado;

	private $mandato;

	private $total_votos;
	

	public function __construct($perfil_id)
	{
		
		$this->perfil_id = $perfil_id;
		$this->setCurtiu_percent();
		$this->setNaocurtiu_percent();
		$this->setMandato();
		$this->set_total_votos();
				

	}

	
	
	public function setCurtiu_percent()
	{

		
		
		$array_curtiu = get_post_meta($this->perfil_id, 'curtiu',true);
		$array_naocurtiu = get_post_meta($this->perfil_id, 'naocurtiu',true);

		$array_curtiu = ($array_curtiu == '') ? array() : $array_curtiu;
		$array_naocurtiu = ($array_naocurtiu == '') ? array() : $array_naocurtiu;

		$total_votos = count($array_naocurtiu) + count($array_curtiu);

		if ($total_votos != 0) {

			$this->curtiu_percent = round(count($array_curtiu) / $total_votos * 100, 2)."%";
		}
		else
		{
			$this->curtiu_percent = "0%";
		}
		
	}

	public function getCurtiu_percent()
	{

		return $this->curtiu_percent;

	}
	
	public function setNaocurtiu_percent()
	{

		$array_curtiu = get_post_meta($this->perfil_id, 'curtiu',true);
		$array_naocurtiu = get_post_meta($this->perfil_id, 'naocurtiu',true);

		$array_curtiu = ($array_curtiu == '') ? array() : $array_curtiu;
		$array_naocurtiu = ($array_naocurtiu == '') ? array() : $array_naocurtiu;

		$total_votos = count($array_naocurtiu) + count($array_curtiu);

		if ($total_votos != 0) {

			$this->naocurtiu_percent = round(count($array_naocurtiu) / $total_votos * 100, 2)."%";
		}
		else
		{
			$this->naocurtiu_percent = "0%";
		}
		
		
		
	}

	public function getNaocurtiu_percent()
	{

		return $this->naocurtiu_percent;

	}
	public function curtir()
	{
		
			
		$array_curtiu = get_post_meta($this->perfil_id , 'curtiu',true);
		$array_naocurtiu = get_post_meta($this->perfil_id , 'naocurtiu',true);
		
		
		if (!empty($array_naocurtiu)) {

			if (in_array(get_current_user_id() , $array_naocurtiu)) {
				
				$indice = array_search(get_current_user_id(), $array_naocurtiu);
				unset( $array_naocurtiu[$indice] );
				
				update_post_meta( $this->perfil_id, 'naocurtiu', $array_naocurtiu);

				}

		}

		

		if (!empty($array_curtiu)) {
			
			if (!in_array(get_current_user_id(), $array_curtiu)) {
				$array_curtiu[] = get_current_user_id();
				update_post_meta( $this->perfil_id, 'curtiu', $array_curtiu );
			
			}


		}
		else
		{
						
			  $array_curtiu[] = get_current_user_id();
		      update_post_meta( $this->perfil_id, 'curtiu', $array_curtiu);
			
		}
		
		
		return true;
		exit;

		


	}

	public function naocurtir()
	{

			
		$array_naocurtiu = get_post_meta( $this->perfil_id, 'naocurtiu',true);
		$array_curtiu = get_post_meta( $this->perfil_id, 'curtiu', true);
		
		
		if (!empty($array_curtiu)) {

			if (in_array(get_current_user_id() , $array_curtiu)) {

				$indice = array_search(get_current_user_id(), $array_curtiu);
				unset( $array_curtiu[$indice] );
				
				update_post_meta(  $this->perfil_id, 'curtiu', $array_curtiu);

				}
		}

		

		if (!empty($array_naocurtiu)) {

			if (!in_array(get_current_user_id() , $array_naocurtiu)) {
			$array_naocurtiu[] = get_current_user_id();
			update_post_meta(  $this->perfil_id, 'naocurtiu', $array_naocurtiu );
				}

		}
		else
		{
			$array_naocurtiu[] = get_current_user_id();
			update_post_meta(  $this->perfil_id, 'naocurtiu', $array_naocurtiu );

		}
		
		return true;
		exit;

	}

	public function verifica_curtida()
	{

		$array_curtiu = get_post_meta($this->perfil_id, 'curtiu',true);
		$array_curtiu = ($array_curtiu == '') ? array() : $array_curtiu;

		if (in_array(get_current_user_id(), $array_curtiu))
		{
			return true;
			exit();
		}

		return false;

	}
	public function verifica_naocurtida()
	{
		$array_naocurtiu = get_post_meta($this->perfil_id, 'naocurtiu',true);
		$array_naocurtiu = ($array_naocurtiu == '') ? array() : $array_naocurtiu;

		if (in_array(get_current_user_id(), $array_naocurtiu))
		{
			return true;
			exit();
		}

		return false;

	}

	public function setMandato()
	{
		$this->mandato = get_post_meta($this->perfil_id, 'mandato',true);

	}
	public function getMandato()
	{
		return $this->mandato;
	}

	public function set_total_votos()
	{

		$array_curtiu = get_post_meta($this->perfil_id, 'curtiu',true);
		$array_naocurtiu = get_post_meta($this->perfil_id, 'naocurtiu',true);

		$array_curtiu = ($array_curtiu == '') ? array() : $array_curtiu;
		$array_naocurtiu = ($array_naocurtiu == '') ? array() : $array_naocurtiu;

		$total_votos = count($array_naocurtiu) + count($array_curtiu);	

		$this->total_votos =  $total_votos;

	}


	public function get_total_votos()
	{

		return $this->total_votos;

	}
			
	

	public function get_projetos_debatidos()
	{
		$projetos_debatidos = get_post_meta($this->perfil_id, 'projetos_debatidos', true ); 

    if (!empty($projetos_debatidos)) {
           $projetos_debatidos = count(array_filter($projetos_debatidos));
       }
    else
    {
        $projetos_debatidos = "0";
    }

    return $projetos_debatidos;
	}		

	

}

?>