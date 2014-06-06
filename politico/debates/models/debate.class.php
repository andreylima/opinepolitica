<?php

class debatesModel {
	
	private $ID;

	private $positivarPercent;

	private $negativarPercent;
	

	
	public function __construct($post_id)
	{
		
		
		$this->ID = $post_id;
		$this->setPositivar_percent();
		$this->setNegativar_percent();
		

	}




}


?>