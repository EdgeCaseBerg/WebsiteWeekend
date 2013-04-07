<?php
/**
*
*
*
**/
class Usagedata{
	public $view;
	public $vars;

	public function usageOverTIme(){
		$array = array('tableName'=>'tblRoomUsage');
		$dbWrapper = new InteractDB('select', $array);
		logThis($dbWrapper->returnedRows);
	}

	public function purpose(){
		// grab all of our purposes
		$query = "SELECT count(1) as peoples, ";
		$query .= "purpose FROM tblRoomUsage tru";
		$query .= " ,tblPurpose p WHERE tru.fkPurpose=p.pkID GROUP BY p.pkID";
		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement($query);
		$purposeData = array();
		for($ii=0; $ii<count($dbWrapper->returnedRows); $ii++){
			$purposeData[$ii]['qty'] = $dbWrapper->returnedRows[$ii]['peoples'];
			$purposeData[$ii]['purpose'] = $dbWrapper->returnedRows[$ii]['purpose'];
		}
		return $purposeData;
	}
	public function byClass(){
		$array = array('tableName'=>'tblRoomUsage');
		$dbWrapper = new InteractDB('select', $array);

	}

	public function getView(){
		return $this->view;
	}

	public function getVars(){
		return $this->vars;
	}
} // end JackModel Class Def