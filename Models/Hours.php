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
		$query = "SELECT fkUserID, fldFirstName, fldLastName, day , hour,endHour FROM tblUserProfile tbp, tblHours th,tblUserAccount tbu WHERE tbp.fkUserID = th.fkCrewID AND tbp.fkUserID = tbu.pkUserID AND tbu.active=1 ORDER BY hour;";
		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement($query);
		$this->vars['hours'] =  $dbWrapper->returnedRows;
		return $this->vars['hours'];
	}

	public function addHours($id,$hour,$day,$endHour){
		$dbWrapper = new InteractDB();
		$query = "INSERT INTO `CSCREW_Website`.`tblHours` (`fkCrewID`, `day`, `hour`,`endHour`) VALUES ('$id', '$day', '$hour','$endHour');";
		$dbWrapper->customStatement($query);

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
		$query= "SELECT tbp.fkUserID, fldFirstName, fldLastName, day , hour, endHour FROM tblUserProfile tbp, tblHours th,tblUserAccount tbu,tblExpertise tl WHERE tbp.fkUserID = th.fkCrewID AND tbp.fkUserID = tbu.pkUserID AND tbu.active=1 AND tl.fkLangID=".$expertise." AND tl.fkUserID = tbp.fkUserID ORDER BY hour;";
		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement($query);
		$this->vars['hours'] =  $dbWrapper->returnedRows;
		return $this->vars['hours'];	
	}

	public function updateHours($id,$newHour,$newEndHour){
		//Id is an array with the fkCrewID in 0th, the day in the 1st,  then the begin and end hour in the next slots
		$query = "UPDATE tblHours SET `hour` = $newHour, `endHour` = $newEndHour WHERE fkCrewID = ".$id[0]." AND day = '".$id[1]."' AND hour = '".$id[2]."' LIMIT 1;";
		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement($query);
		if($dbWrapper->errorCondition->errorInfo[1] == 2053){
			//A 2053 means it worked... weird but true
			$this->vars['success'] = true;
		}else{
			$this->vars['success'] = false;
			return false;
		}
		return $this->vars['success'];	
	}

	public function deleteHours($info){
		//info is an array with pkid in 0, day in 1, hour in 2
		$query = "DELETE FROM tblHours WHERE fkCrewID='$info[0]' AND day='$info[1]' AND hour='$info[2]'; ";
		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement($query);
		if($dbWrapper->errorCondition->errorInfo[1] == 2053){
			//A 2053 means it worked... weird but true
			$this->vars['success'] = true;
		}else{
			$this->vars['success'] = false;
			return false;
		}
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