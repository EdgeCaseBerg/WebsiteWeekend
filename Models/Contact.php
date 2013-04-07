<?php

class Contact{
	// if we ended up here it is because we called a page with no associated model. 
	public $view;
	public $vars;

	function __construct($query){
		$this->view = $query;

	}

	public function getContacts(){
		$dbWrapper = new InteractDB('select',array('tableName'=>'tblContactEmails'));
		$this->vars['emails'] =  $dbWrapper->returnedRows;
		return $this->vars['emails'];
	}

	public function addEmail($email){

	}

	public function deleteEmail($email){

	}

	public function getView(){
		if($this->view){
			return $this->view;
		}else{return false;}
	}
}



?>