<?php
/**
*
*
*
**/
class Member{
	public $view;
	public $vars;

	function __construct($query){
		$this->view = $query;
	}

	public function getMembers(){
		// grab all of our purposes
		$query = "SELECT fldProfileImage as image,fldFirstName as fname,fldLastName as lname,fldPersonalURL as url, fldEmail as email,fldAboutMe as aboutme FROM tblUserProfile tp, tblUserAccount ta WHERE tp.fkUserID=ta.pkUserID AND ta.active=1;";		
		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement($query);
		$this->vars['info'] = $dbWrapper->returnedRows;
		return $this->vars['info'];
	}
	
	public function getView(){
		return $this->view;
	}

	public function getVars(){
		return $this->vars;
	}
} // end JackModel Class Def