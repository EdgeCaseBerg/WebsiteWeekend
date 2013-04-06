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

	public function logUsage($info){
		$toDb = array('tableName' => 'tblRoomUsage', 
				'uvmID' => $info['uvm_id'],
				'fkPurpose' => $info['purpose'],
				'description' => $info['description'],
				'classYear' => $info['class']
			);
		$dbWrapper = new InteractDB('insert',$toDb);
	}

	public function getView(){
		if($this->view){
			return $this->view;
		}else{return false;}
	}
}



?>