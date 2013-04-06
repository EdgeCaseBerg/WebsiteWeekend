<?php

class RoomSignIn{
	// if we ended up here it is because we called a page with no associated model. 
	public $view;
	public $vars;

	function __construct($query){
		$this->view = $query;

	}

	public function getPurpose(){
		$dbWrapper = new InteractDB('select',array('tableName'=>'tblPurpose'));
		$this->vars['purposes'] =  $dbWrapper->returnedRows;
		return $this->vars['purposes'];
	}

	public function getView(){
		if($this->view){
			return $this->view;
		}else{return false;}
	}
}



?>