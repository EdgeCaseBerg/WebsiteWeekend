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
		return $this->vars['hours'];
	}

	public function getActiveMembers(){
		$query = "SELECT fkUserID, fldFirstName, fldLastName FROM tblUserProfile tbp, tblUserAccount tbu WHERE tbp.fkUserID = tbu.pkUserID AND tbu.active=1";
		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement($query);
		$this->vars['members'] =  $dbWrapper->returnedRows;
		return $this->vars['members'];	
	}

	public function getAllHoursByExpertise($expertise=0){
		if($expertise=="Show+all"){
			return $this->getAllHours();
		}
		$query= "SELECT tbp.fkUserID, fldFirstName, fldLastName, day , hour FROM tblUserProfile tbp, tblHours th,tblUserAccount tbu,tblExpertise tl WHERE tbp.fkUserID = th.fkCrewID AND tbp.fkUserID = tbu.pkUserID AND tbu.active=1 AND tl.fkLangID=".$expertise." AND tl.fkUserID = tbp.fkUserID ORDER BY hour;";
		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement($query);
		$this->vars['hours'] =  $dbWrapper->returnedRows;
		return $this->vars['hours'];	
	}

	public function updateHours($id,$newHour){
		$query = "UPDATE tblHours SET `hour` = $newHour WHERE fkCrewID = ".$id[0]." AND day = '".$id[1]."' AND hour = '".$id[2]."' LIMIT 1;";
		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement($query);
		$this->vars['success'] =  $dbWrapper->returnedRows;
		logThis($this->vars['success']);
		return $this->vars['success'];	
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