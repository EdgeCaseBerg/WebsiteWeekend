<?php

class DefaultModel{
	// if we ended up here it is because we called a page with no associated model. 
	public $view;

	function __construct($query){
		$this->view = $query;
	}

	public function getView(){
		if($this->view){
			return $this->view;
		}else{return false;}
	}
}



?>