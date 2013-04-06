<?php
class NewsModel{
	/*	DEPRICATED, USE NEWS AND NEWSBUNDLE INSTEAD
		NewsModel class
		Used to interact with the database on behalf of the NewsController. 
		Provided methods to retrieve all news stories from the database, or specific ones based on their
		ID.
	*/
	public function retrieveAllStories(){
		/*
			retrieveAllStories
			Used to retrieve all the stories from the database.
			Returns:
				an array containing all stories retrieved in this way.
		*/
		// logThis("Arrived at retrieveAllStories");

		$dbWrapper = new InteractDB('select', array('tableName'=>'tblNews'));
		$result = $dbWrapper->returnedRows;

		// if the query fails, let us know
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die(logThis($message));
		}

		// logThis($result);
		return $result;
	}

	public function retrieveStory($id){
		$dbWrapper = new InteractDB('select', array('tableName'=>'tblNews','id'=>$id));
	}
}

?>