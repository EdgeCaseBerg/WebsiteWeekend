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

	public function addProject($team,$projName,$url,$status,$description){
		$dbWrapper = new InteractDB();
		$query = "INSERT INTO tblProjects (team, projName, url, status, description) VALUES ('$team', '$projName', '$url', '$status', '$description')";
		$dbWrapper->customStatement($query);
		$this->vars['result'] = $dbWrapper->returnedRows;
		return $this->vars['result'];
	}

	public function getView(){
		if($this->view){
			return $this->view;
		}else{return false;}
	}
}



?>