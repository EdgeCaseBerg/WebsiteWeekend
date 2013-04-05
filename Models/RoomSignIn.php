<?php

class RoomSignIn{
	// if we ended up here it is because we called a page with no associated model. 
	public $view;

	function __construct($query){
		$this->view = $query;
	}

	public getPurpose(){
		$dbWrapper = new InteractDB('select',array('tablename'=>'tblPurpose'));
		$this->vars['purpose'] =  $dbWrapper->returnedRows;
		
	}

	public function getView(){
		if($this->view){
			return $this->view;
		}else{return false;}
	}
}



?>