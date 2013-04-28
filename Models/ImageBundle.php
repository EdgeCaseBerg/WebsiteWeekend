<?php
	class ImageBundle{
		public function retrieveAll(){
			$query ="SELECT * FROM tblFrontPageImages ORDER BY sort_order";
			$dbObject = new InteractDB();
			$dbObject->customStatement($query);
			$imageArray = array();
			foreach ($dbObject->returnedRows as $images) {
				$image = new Image();
				$image->setId($images['id']);
				$image->setPath($images['path']);
				$image->setDescription($images['description']);
				$image->setTitle($images['title']);
				$image->setSortOrder($images['sort_order']);
				array_push($imageArray, $image);
			} 
			return $imageArray;
		}

		public function galleriaData(){
			$imageArray = $this->retrieveAll();
			$jsonArray= array();
			foreach($imageArray as $image){
				$tempImage = array('image' => BASEDIR.'Views/images/gallery/'.$image->getPath(),
							  'title' => $image->getTitle(),
							  'description' => $image->getDescription());
				array_push($jsonArray, $tempImage);
			}
			logThis($jsonArray);
			return json_encode($jsonArray);
		}
	}
?>