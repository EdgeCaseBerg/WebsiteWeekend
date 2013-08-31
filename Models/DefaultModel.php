<?php

class DefaultModel{
	// if we ended up here it is because we called a page with no associated model. 
	public $view;
	public $vars;

	function __construct($query){
		$this->view = $query;
		require_once "Models/NewsBundle.php";
		$modelObject = new NewsBundle;
		$this->vars = $modelObject->retrieveAllPublished();
	}

	public function getView(){
		if($this->view){
			return $this->view;
		}else{return false;}
	}

	public function getVars(){
		return $this->vars;
	}
}



?>