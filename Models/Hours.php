<?php

class Hours{
	// if we ended up here it is because we called a page with no associated model. 
	public $view;
	public $vars;

	function __construct($query){
		$this->view = $query;

	}

	public function getAllHours(){
		//Gets Hours without any expertise search
		$query = "SELECT fkUserID, fldFirstName, fldLastName, day , hour FROM tblUserProfile tbp, tblHours th,tblUserAccount tbu WHERE tbp.fkUserID = th.fkCrewID AND tbp.fkUserID = tbu.pkUserID AND tbu.active=1 ORDER BY hour;";
		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement($query);
		$this->vars['hours'] =  $dbWrapper->returnedRows;
		logThis($this->vars['hours']);
		return $this->vars['hours'];
	}

	public function getAllHoursByExpertise($expertise=0){
		if($expertise=="Show+all"){
			return $this->getAllHours();
		}
		$query= "SELECT tbp.fkUserID, fldFirstName, fldLastName, day , hour FROM tblUserProfile tbp, tblHours th,tblUserAccount tbu,tblExpertise tl WHERE tbp.fkUserID = th.fkCrewID AND tbp.fkUserID = tbu.pkUserID AND tbu.active=1 AND tl.fkLangID=".$expertise." AND tl.fkUserID = tbp.fkUserID ORDER BY hour;";
		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement($query);
		$this->vars['hours'] =  $dbWrapper->returnedRows;
		logThis($this->vars['hours']);
		return $this->vars['hours'];	
	}

	public function getLanguages(){
		$dbWrapper = new InteractDB('select',array('tableName'=>'tblLanguages'));
		$this->vars['languages'] =  $dbWrapper->returnedRows;
		return $this->vars['languages'];
	}

	public function getView(){
		if($this->view){
			return $this->view;
		}else{return false;}
	}
}



?>