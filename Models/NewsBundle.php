<?php
require_once 'News.php';
class NewsBundle{

	public function RetrieveAll(){
		$stories = new InteractDB('select', array('tableName'=> 'tblNews'));
		$newsArray = array();
		foreach($stories->returnedRows as $story){
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