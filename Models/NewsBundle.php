<?php
require_once 'News.php';
class NewsBundle{

	public function RetrieveAll(){
		$dbObject= new InteractDB();
		$select = "SELECT * FROM tblNews ORDER BY 'created_at'";
		$dbObject->customStatement($select); 
		$newsArray = array();
		foreach(array_reverse($dbObject->returnedRows) as $story){
			$news = new News();
			$news->setId($story['id']);
			$news->setTitle($story['title']);
			$news->setPath($story['path']);
			$news->setImage($story['image']);
			$news->setCreatedAt($story['created_at']);
			array_push($newsArray, $news);
		}
		return $newsArray;
	}
}
?>