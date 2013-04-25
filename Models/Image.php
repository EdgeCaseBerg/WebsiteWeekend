<?php

class Image{
	private $id=null;
	private $path=null;
	private $description=null;
	private $title=null;
	private $sort_order=null;

	public function initById($id){
		$dbObject = new InteractDB();
		$statement = 'SELECT * FROM tblFrontPageImages WHERE id = "'.$id.'"';
		$dbObject->customStatement($statement);
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

	public function save(){
		if($this->id !== null){
			$query= 'UPDATE tblFrontPageImages SET sort_order="'.$this->sort_order.'", title="'.$this->title.'", description="'.$this->description.'" WHERE id="'.$this->id.'"';
			$dbObject = new InteractDB();
			$dbObject->customStatement($query);
		}else{
			$query = "";
		}
	}			
}

?>