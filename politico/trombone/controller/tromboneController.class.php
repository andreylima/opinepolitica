<?php


class tromboneController {
	
private $denuncia_completa;




	public function __construct($perfil_id)
	{
		
		$this->setDenuncia_completa();

	}


		public function setDenuncia_completa()
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

	public function getDenuncia_completa()
	{

		return $this->curtiu_percent;

	}



}

?>