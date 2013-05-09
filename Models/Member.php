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

	public function getMembers($start=0,$limit=10){
		$query = "SELECT pkUserId as profLink, fldProfileImage as image,fldFirstName as fname,fldLastName ";
		$query .= "as lname,fldPersonalURL as url, fldEmail as email,fldAboutMe as aboutme FROM tblUserProfile ";
		$query .= "tp, tblUserAccount ta WHERE tp.fkUserID=ta.pkUserID AND ta.active=1 LIMIT :start , :limit;";		
		$dbWrapper = new InteractDB();
		$arr = array(':start'=>$start, ':limit'=>$limit);
		$dbWrapper->customStatement($query, $arr);
		$this->vars['info'] = $dbWrapper->returnedRows;
		return $this->vars['info'];
	}

	public function getMembersAdmin($start=0,$limit=10){
		$query = "SELECT pkUserID,fldUsername as username, fldFirstName as fname,fldLastName as lname, fldEmail ";
		$query .= "as email, active, fldAuth as auth  FROM tblUserProfile tp, tblUserAccount ta WHERE ";
		$query .= "tp.fkUserID=ta.pkUserID ORDER BY ISNULL(tp.fldFirstName), ISNULL(tp.fldLastName),username ASC LIMIT :start , :limit;";		
		$dbWrapper = new InteractDB();
		$arr = array(':start'=>$start, ':limit'=>$limit);
		$dbWrapper->customStatement($query, $arr);
		$this->vars['info'] = $dbWrapper->returnedRows;
		return $this->vars['info'];
	}

	public function setMemberActive($id,$active=false){
		$query = 'UPDATE tblUserAccount SET active = :active WHERE pkUserID = :id;';
		$dbWrapper = new InteractDB();
		$arr = array(':active'=>$active, ':id'=>$id);
		$dbWrapper->customStatement($query, $arr);
		$this->vars['success'] = $dbWrapper->returnedRows;
		return $this->vars['success'];	
	}

	public function setMemberAuth($id,$auth=0){
		$query = 'UPDATE tblUserAccount SET fldAuth = :auth WHERE pkUserID = :id;';
		$dbWrapper = new InteractDB();
		$arr = array(':auth'=>$auth, ':id'=>$id);
		$dbWrapper->customStatement($query, $arr);
		$this->vars['success'] = $dbWrapper->returnedRows;
		return $this->vars['success'];		
	}

	public function deleteMember($id){
		$query = 'DELETE FROM tblUserAccount WHERE pkUserID = :id;';
		$dbWrapper = new InteractDB();
		$arr = array(':id'=>$id);
		$dbWrapper->customStatement($query, $arr);
		$this->vars['success'] = $dbWrapper->returnedRows;
		return $this->vars['success'];			
	}
	
	public function getView(){
		return $this->view;
	}

	public function getVars(){
		return $this->vars;
	}
} // end JackModel Class Def