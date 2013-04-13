<?php


	class News{
		public $id = null;
		public $title = null;
		public $path = null;
		public $image = null;
		public $created_at= null;
		public $is_published=null;
		public $vars;

		public function initById($id){
			$story = new InteractDB('select', array('tableName' => 'tblNews','id' => $id));
			$values = $story->returnedRows;
			$this->id = intval($values[0]['id']);
			$this->title = $values[0]['title'];
			$this->path = $values[0]['path'];
			$this->image = $values[0]['image'];
			$this->created_at = $values[0]['created_at'];
			$this->is_published= intval($values[0]['is_published']);

		}

		public function toArray(){
			$storyArray = array('id' =>$this->id,
							'title' =>$this->title,
							'path' =>$this->path,
							'image'=>$this->image,
							'created_at'=>$this->created_at,
							'is_published'=>$this->is_published);
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

		public function setIsPublished($is_published){
			$this->is_published = $is_published;
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

		public function getIsPublished(){
			return $this->is_published;
		}

		public function saveHtml($html){
			//make sure it knows where to go
			if($this->path!==null){
				$exists = file_exists("Views/Stories/Content/".$this->path.".php");
				//If the file exits delete it and recreate it
				if($exists){
					unlink("Views/Stories/Content/".$this->path.".php");
				}
			}else{
				$this->generatePath();
			}
			//now write to it
			$handle = fopen("Views/Stories/Content/".$this->path.".php",'w');
			fwrite($handle,$html);
			//now close it
			fclose($handle);

		}
 
		public function generatePath(){
			logThis('Im in generate path');
			if($this->path === null){
				$dbObject= new InteractDB('select', array('tableName'=>'tblNews', 'title'=> $this->title));
				if(count($dbObject->returnedRows)>0){
					$index = (string)(count($dbObject->returnedRows)+1);
				}else{
					$index = '1';
				}
				$parts = explode(' ', $this->title);
				$tempPath = '';
				foreach ($parts as $part) {
					$tempPath .= $part;
					$tempPath .= "_";
				}
				$tempPath .= $index;
				$this->path = $tempPath;
			}
			return false;	
		}

		public function save(){
			if($this->id !== null){
				$statement = 'UPDATE tblNews SET image= "'.$this->image.'", is_published= "'.$this->is_published.'" WHERE id= "'. $this->id . '"';
				logThis($statement);
			}else{
				$this->created_at =  date('Y-m-d H:i:s');
				$values = "'".$this->title."', '".$this->created_at."', '".$this->path."', '".$this->image."'";
				$path= "path";
				$statement = 'INSERT into tblNews (title, created_at, '.$path.', image) VALUES ('.$values.')';
			}
			$dbObject = new InteractDB();
			$dbObject->customStatement($statement);
			return $dbObject->connection->lastInsertId();
		}

		public function delete(){
			$return = false;
			if($this->id !== null){
				$statement = 'DELETE from tblNews WHERE id = '.$this->id;
				error_log("Statement: ".$statement);
				$dbObject = new InteractDB();
				$dbObject->customStatement($statement);
				$return = true;
			}
			error_log("Return: ".$return);
			return $return;
		}

		public function displayDate(){
			$date = '';
			if($this->created_at !== null){
				$dateParts = explode(' ', $this->created_at);
				$dateDMY = explode('-', $dateParts[0]);
				$date = $dateDMY[1]."/".$dateDMY[2]."/".$dateDMY[0];
			}
			error_log("Return: ". $date);
			return $date;
		}

	}

?>