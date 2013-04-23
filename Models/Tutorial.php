<?php

class Tutorial{
	// if we ended up here it is because we called a page with no associated model. 
	public $view;
	public $vars;

	function __construct($query){
		$this->view = $query;

	}

	public function addTutorial($url,$title){
		$info = array('tableName' => 'tblTutorials','pkTutorialId'=>date('U'),'fldURL' => $url, 'fldTitle' => $title);
		$dbWrapper = new InteractDB('insert',$info);	
	}

	public function updateTutorial($update,$data,$id){
		switch ($update) {
			case 'url':
				$update = 'fldURL';
				break;
			case 'title':
				$update = 'fldTitle';
				break;
			case 'cat':
				$update = 'fldCategory';
				break;
			default:
				return false;
				break;
		}
		$info = array('tableKeyName' => 'pkTutorialId', 'tableKey'=>$id,'tableName'=>'tblTutorials',"$update"=>$data);
		$dbWrapper = new InteractDB('update',$info);
		//Always executes... and no way to see if it worked.
		return true;
	}

	public function publishTutorial($id,$pubbed){
		logThis($pubbed);
		$info = array('tableKeyName' => 'pkTutorialId', 'tableKey'=>$id,'tableName'=>'tblTutorials',"fldPublished"=>$pubbed);
		$dbWrapper = new InteractDB('update',$info);
		//Always executes... and no way to see if it worked.
		return true;
	}

	public function getTutorials(){
		//info is an array with pkid in 0, day in 1, hour in 2
		$query = "SELECT fldURL as url, fldTitle as title, fldCategory as cat FROM tblTutorials WHERE fldPublished = 1 ORDER BY fldCategory";
		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement($query);
		//PreProcess the returned rows into their categories
		$tuts = $dbWrapper->returnedRows;
		$tutorials = array();
		foreach ($tuts as $tut) {
			//Append each tutorial into it's respective category
			$tutorials[$tut['cat']][] = $tut;
		}
		return $tutorials;
	}

	public function getTutorialsByPublished($published){
		//info is an array with pkid in 0, day in 1, hour in 2
		$query = "SELECT fldURL as url, fldTitle as title, fldCategory as cat FROM tblTutorials WHERE fldPublished = $published ORDER BY fldCategory";
		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement($query);
		//PreProcess the returned rows into their categories
		$tuts = $dbWrapper->returnedRows;
		$tutorials = array();
		foreach ($tuts as $tut) {
			//Append each tutorial into it's respective category
			$tutorials[$tut['cat']][] = $tut;
		}
		return $tutorials;
	}

	public function getAllTutorials(){
		//info is an array with pkid in 0, day in 1, hour in 2
		$query = "SELECT fldPublished as published, pkTutorialId as id, fldURL as url, fldTitle as title, fldCategory as cat FROM tblTutorials ORDER BY fldCategory";
		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement($query);
		//PreProcess the returned rows into their categories
		$tuts = $dbWrapper->returnedRows;
		$tutorials = array();
		foreach ($tuts as $tut) {
			//Append each tutorial into it's respective category
			$tutorials[$tut['cat']][] = $tut;
		}
		return $tutorials;
	}

	public function getView(){
		if($this->view){
			return $this->view;
		}else{return false;}
	}
}



?>