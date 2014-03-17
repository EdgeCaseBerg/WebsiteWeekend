<?php
/**
*
*
*
**/
class Jack{
	public $view;
	public $vars;

	// gets all the possible languages for memeber expertise
	public function getMemberLangs($userID){
		if($userID != null){
			$array= array(
				'tableName'=>'tblLanguages',
				'fkUserID'=> $userID
			);
		}else{
			$array= array(
				'tableName'=>'tblLanguages'
			);
		}
		$dbWrapper = new InteractDB('select', $array);
		return $dbWrapper->returnedRows;
	}

	public function getView(){
		return $this->view;
	}

	public function getVars(){
		return $this->vars;
	}
} // end JackModel Class Def