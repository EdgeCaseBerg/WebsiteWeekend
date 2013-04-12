<?php

class Projects{
	// if we ended up here it is because we called a page with no associated model. 
	public $view;
	public $vars;

	function __construct($query){
		$this->view = $query;

	}

	public function getProjects(){
		$dbWrapper = new InteractDB('select',array('tableName'=>'tblProjects'));
		$this->vars['projects'] =  $dbWrapper->returnedRows;
		return $this->vars['projects'];
	}

	public function getView(){
		if($this->view){
			return $this->view;
		}else{return false;}
	}
}



?>