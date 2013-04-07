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
		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement("INSERT INTO tblContactEmails VALUES (null,'$email');");
		return $dbWrapper->returnedRows;
	}

	public function deleteEmail($id){
		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement("DELETE FROM tblContactEmails WHERE pkID=$id");
		if($dbWrapper->errorCondition->errorInfo[1] == 2053){
			//A 2053 means it worked... weird but true
			$this->vars['success'] = true;
		}else{
			$this->vars['success'] = false;
			return false;
		}
		return $this->vars['success'];
	}

	public function updateEmail($id,$new){
		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement("UPDATE tblContactEmails SET `email` = '$new' WHERE pkID = $id;");
		if($dbWrapper->errorCondition->errorInfo[1] == 2053){
			//A 2053 means it worked... weird but true
			$this->vars['success'] = true;
		}else{
			$this->vars['success'] = false;
			return false;
		}
		return $this->vars['success'];
	}

	public function getView(){
		if($this->view){
			return $this->view;
		}else{return false;}
	}
}



?>