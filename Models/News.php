<?php


	class News{
		public $id = null;
		public $title = null;
		public $path = null;
		public $image = null;
		public $created_at= null;

		public function initById($id){
			$story = new InteractDb('select', array('tableName' => 'tblNews','id' => $id));
			$values = $story->returnedRows;
			logThis($values);
			$this->id = $values[0]['id'];
			$this->title = $values[0]['title'];
			$this->path = $values[0]['path'];
			$this->image = $values[0]['image'];
			$this->created_at = $values[0]['created_at'];
		}

		public function toArray(){
			$storyArray = array('id' =>$this->id,
							'title' =>$this->title,
							'path' =>$this->path,
							'image'=>$this->image,
							'created_at'=>$this->created_at);
			return $storyArray;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function setTitle($title){
			$this->title = $title;
		}

		public function setPath($path){
			$this->path = $path;
		}

		public function setImage($image){
			$this->image = $image;
		}

		public function setCreatedAt($created_at){
			$this->created_at = $created_at;
		}

		public function getId(){
			return $this->id;
		}

		public function getTitle(){
			return $this->title;
		}

		public function getPath(){
			return $this->path;
		}

		public function getImage(){
			return $this->image;
		}

		public function getCreatedAt(){
			return $this->created_at;
		}

	}

?>