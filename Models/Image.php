<?php

class Image{
	private $id=null;
	private $path=null;
	private $description=null;
	private $title=null;
	private $sort_order=null;

	public function initById($id){
		$dbObject = new InteractDB();
		$statement = 'SELECT * FROM tblFrontPageImages WHERE id = ?';
		$arr = array($id);
		$dbObject->customStatement($statement, $arr);
		if($dbObject->returnedRows){
			$this->id = $dbObject->returnedRows[0]['id'];
			$this->path= $dbObject->returnedRows[0]['path'];
			$this->description = $dbObject->returnedRows[0]['description'];
			$this->title = $dbObject->returnedRows[0]['title'];
			$this->sort_order = $dbObject->returnedRows[0]['sort_order'];
		}
	}

	public function imageToArray(){
		$imageArray = array('id' => $this->id,
							'path' => $this->path,
							'description' => $this->description,
							'title' => $this->title,
							'sort_order' => $this->sort_order);
		return $imageArray;
	}

	public function setId($id){
		$this->id = $id;		
	}

	public function setPath($path){
		$this->path = $path;		
	}

	public function setDescription($description){
		$this->description = $description;		
	}

	public function setTitle($title){
		$this->title = $title;		
	}

	public function setSortOrder($sort_order){
		$this->sort_order = $sort_order;		
	}

	public function getId(){
		return $this->id;
	}

	public function getPath(){
		return $this->path;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getTitle(){
		return $this->title;
	}

	public function getSortOrder(){
		return $this->sort_order;
	}

	public function retrieveHighestSortOrder(){
		$query = "SELECT COUNT(id) FROM tblFrontPageImages";
		$dbObject = new InteractDB();
		$dbObject->customStatement($query);
		if(sizeof($dbObject->returnedRows) > 0){
			$this->sort_order = ($dbObject->returnedRows[0][0] + 1);
		}else{
			$this->sort_order = 1;
		}
		
	}

	public function save(){
		if($this->id !== null){
			$query= "UPDATE tblFrontPageImages SET sort_order=?, title=?, description=? WHERE id=?";
			$arr = array($this->sort_order, $this->title, $this->description, $this->id);
			$dbObject = new InteractDB();
			$dbObject->customStatement($query, $arr);
		}else{
			$this->retrieveHighestSortOrder();
			if($this->path != null && $this->title!=null && $this->description!=null && $this->sort_order != null){
				$query = "INSERT INTO tblFrontPageImages (path, title, description, sort_order) VALUES ('?', '?', '?', '?')";
				$arr = array($this->path, $this->title, $this->description, $this->sort_order);
				$dbObject = new InteractDB();
				$dbObject->customStatement($query, $arr);
			}
		}
	}

	public function delete(){
		if($this->id != null){
			$query = "DELETE FROM tblFrontPageImages WHERE id = ?";
			$dbObject = new InteractDB();
			$arr = array($this->id);
			$dbObject->customStatement($query, $arr);
		}
	}
}

?>