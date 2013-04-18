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

	public function addGithubFeed($url){
		if(preg_match('/github/', $url) && !preg_match('/atom/', $project['url'])) {

			//Add the /commits/master.atom to a github link that doesn't have it.
			//Regex for an ending slash /
			if(preg_match('/\/$/', $url)){
				return $url . 'commits/master.atom';
			}else{
				//Hopefully there's a master branch
				return $url . '/commits/master.atom';
			}
		}
		//not a github feed
		return $url;
	}

	public function deleteProject($id){
		$dbWrapper = new InteractDB();
		$query = "DELETE FROM tblProjects WHERE pkID=".$id;
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

	public function updateField($id,$field,$newData){
		$dbWrapper = new InteractDB();
		$query = "UPDATE tblProjects SET $field = '$newData' WHERE pkID=$id";
		$dbWrapper->customStatement($query);
		if($dbWrapper->errorCondition->errorInfo[1] == 2053){
			//A 2053 means it worked... weird but true
			$this->vars['success'] = true;
			return true;
		}else{
			$this->vars['success'] = false;
			return false;
		}
		return $dbWrapper->returnedRows;	
	}

	public function getView(){
		if($this->view){
			return $this->view;
		}else{return false;}
	}
}



?>