<?php

// Author: Joshua Dickerson
// InteractDB is a MySQL database wrapper class for performing simple SELECT, INSERT, and UPDATE queries
// object is instanciated as follows:
// new InteractDB('select', array); 
// where 'select' is the action to be performed and array contains a field called tableName 

class InteractDB{
	// as defined in config.php
	private $dbName = DATABASE_NAME;
	private $host = DATABASE_HOST;
	private $dbPass = DATABASE_PASS;
	private $user = DATABASE_USER;
	public $dsn = null;	// for PDO
	public $error = false; // if we catch an error set to true 
	public $errorCondition;
	public $connection = null;
	public $action = null;			// this is the action to be performed on the DB (SELECT INSERT etc)
	public $numberEntries = null;	// this is the number of total items to be acted upon
	private $data = array();		// the array of data to be INSERTED (or whatever)
	public $returnedRows = array();


	function __construct($action = null, $data = null){
		// logThis('InteractDB called');
		if (!defined('PDO::ATTR_DRIVER_NAME')) {
			$_SESSION['error'] = true;
			$_SESSION['fail_message'] = "PDO Not Installed";
		}
		$this->dsn = "mysql:dbname=".DATABASE_NAME.";host=".DATABASE_HOST;
		$this->data = $data;
		$this->connection = $this->dbConnect();
		$this->action = $action;
		$this->parseActions();
	}



	private function parseActions(){
		switch($this->action){
			case "insert":
			$this->insertStatement();
			break;

			case "select":
			$this->selectStatement();
			break;

			case "update":
			$this->updateStatement();
			break;
		}

	} // end parseActions



	public function dbConnect(){
		//Connect to the database and select the database		
		try{
			$connection = new PDO($this->dsn, DATABASE_USER, DATABASE_PASS);
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			return $connection;
		}catch(PDOException $err){
			$this->error = true;
			$this->errorCondition = $err;
			logThis($this->errorCondition);
			$_SESSION['error'] = true;
			$_SESSION['fail_message'] = "DB Connect Failed";
		}	// if we cant connect, return null	
	} // end dbConnect


	private function selectStatement(){
		$data = $this->data;
		$connection = $this->connection;
		$numEntries = $this->numberEntries;
		$tableName = $data['tableName'];	// tableName must be specified
		unset($data['tableName']);


		// A temporary array to hold the fields in an intermediate state
		$whereClause = array();

		// Iterate over the data and convert to individual clause elements
		foreach ($data as $key => $value) {
		    $whereClause[] = "$key = :$key";
		}
		// Construct the query
		if (count($whereClause) > 0 ){
			// we have a conditional
			$query = 'SELECT * FROM '.$tableName.' WHERE '.implode(' OR ', $whereClause).'';

		}else{
			// grab all rows from table
			$query = 'SELECT * FROM '.$tableName.';';
		}

		// logThis($query);

		if(!$this->error){
			// Prepare the query
			try{
				$stmt = $connection->prepare($query);
				$stmt->execute($data);
				$this->returnedRows = $stmt->fetchAll();
			}catch(Exception $e){
				$this->error = true;
				$this->errorCondition = $e;
				logThis($e, true, 'dbError');
			}
		}
	} // end selectStatement

	private function insertStatement(){
		$data = $this->data;
		$connection = $this->connection;
		$numEntries = $this->numberEntries;
		$tableName = $data['tableName'];	// tableName must be specified
		unset($data['tableName']);
		$questionMarks = "";;

		// A temporary array to hold the fields in an intermediate state
		$fieldName = array();
		$fieldValue = array();

		// Iterate over the data and convert to individual clause elements
		foreach ($data as $key => $value) {
		    $fieldName[] = "$key,";
		    $fieldValue[] = ":$key,";
		}
		$fieldNames = rtrim(implode($fieldName), ",");
		$fieldValues = rtrim(implode($fieldValue), ",");
		
		if(!$this->error){
			try{
				// Construct the query
				$query = 'INSERT INTO '.$tableName.' ('.$fieldNames.') VALUES ('.$fieldValues.');';
				// logThis($query);
				// // Prepare the query
				$stmt = $connection->prepare($query);
				// // Execute the query
				$stmt->execute($data);
			}catch(Exception $e){
				$this->error = true;
				//logThis($e);
				$this->errorCondition = $e;
			}
		}
	} // end insertStatement

	private function updateStatement(){

		// the data array must contain an entry for $data['tableName'] for the SQL WHERE clause
		// the data array must contain an entry for $data['tableKeyName'] for the SQL WHERE clause
		// the data array must contain an entry for $data['tableKey'] for the SQL WHERE clause
		$data = $this->data;
		// var_dump($data);
		if(!isset($data['tableName']) || (!isset($data['tableKeyName'])) || (!isset($data['tableKey']))){
			// do error because we don't have enough info to do a proper update
			echo "not working";
		}else{
		$connection = $this->connection;
		$numEntries = $this->numberEntries;
		$tableName = $data['tableName'];	// tableName must be specified
		$tableKeyName = $data['tableKeyName'];	// tableKeyName must be specified
		$tableKey = $data['tableKey'];	// tableKey must be specified
		unset($data['tableKeyName']);
		unset($data['tableKey']);
		unset($data['tableName']);



		// A temporary array to hold the fields in an intermediate state
		$whereClause = array();

		// Iterate over the data and convert to individual clause elements
		foreach ($data as $key => $value) {
		    $whereClause[] = "$key = :$key";
		}
			if(!$this->error){
				try{
					// Construct the query
					$query = 'UPDATE '.$tableName.' SET '.implode(', ', $whereClause).' WHERE '.$tableKeyName.' ="'.$tableKey.'";';
					// Prepare the query
					logThis(query);
					// var_dump($query);
					$stmt = $connection->prepare($query);
					logThis($data);
					// Execute the query
					$stmt->execute($data);
				}catch (Exception $e){
					echo $e;
					logThis($e);
					$this->error = true;
					$this->errorCondition = $e;
				}
			}
		} // end error checking else clause
	} // end insertStatement


	public function customStatement($query, $array = false){
		// shortcutting, to temporarily fix PDO issues
		// not secure !!
		// $con = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
		// mysqli_query($con, $query);
		// mysqli_close($con);
		$connection = $this->connection;
		if(!$array){
			// LogThis("------------");
			if(!$this->error){
				try{
					// var_dump($query);
					$stmt = $connection->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
					// logThis($stmt);
					// Execute the query
					$stmt->execute();
					if(stripos($query, 'INSERT')===false && stripos($query, 'UPDATE')===false && stripos($query, 'DELETE')===false){
						$this->returnedRows = $stmt->fetchAll();
					}
				}catch (Exception $e){
					logThis($e);
					$this->error = true;
					$this->errorCondition = $e;
				}
			}
		}else{
			logThis($this->error);
			if(!$this->error){
				try{
					// var_dump($query);
					$stmt = $connection->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
					//logThis($stmt);
					// Execute the query
					$stmt->execute($array);
					// logThis($stmt);
					if(stripos($query, 'INSERT')===false && stripos($query, 'UPDATE')===false && strpos($query, 'DELETE')===false){
						$this->returnedRows = $stmt->fetchAll();
					}
				}catch (Exception $e){
					logThis($e);
					$this->error = true;
					$this->errorCondition = $e;
				}
			}
		}
	} // customStatement


	public function customMysqli($query){
		// logThis($query);
		$con = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
		$result = mysqli_query($con, $query);
		while($row = mysqli_fetch_array($result)){
			array_push($this->returnedRows, $row);
		}
		mysqli_close($con);
	}

	// public function customStatement($query){
	// 	// shortcutting, to temporarily fix PDO issues
	// 	// not secure !!
	// 	// $con = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
	// 	// mysqli_query($con, $query);
	// 	// mysqli_close($con);

	// 	$connection = $this->connection;

	// 	if(!$this->error){
	// 		try{
	// 			// var_dump($query);
	// 			$stmt = $connection->prepare($query);
	// 			//logThis($stmt);
	// 			// Execute the query
	// 			$stmt->execute();
	// 			//logThis($stmt);
	// 			$this->returnedRows = $stmt->fetchAll();
	// 		}catch (Exception $e){
	// 			logThis($e);
	// 			$this->error = true;
	// 			$this->errorCondition = $e;
	// 		}
	// 	}
	// } // customStatement

	public function getError(){
		if($this->error){
			return $this->errorCondition;
		}else{
			return false;
		}
	}

	public function getTables(){
		$qry = "SELECT table_name, engine FROM information_schema.tables WHERE table_type = 'BASE TABLE' AND table_schema='".DATABASE_NAME."' ORDER BY table_name ASC;";
		$this->customStatement($qry);
		return $this->returnedRows;
	}

	public function getNumRows($tableName){
		// $qry = "SELECT table_name, engine FROM information_schema.tables WHERE table_type = 'BASE TABLE' AND table_schema='".DATABASE_NAME."' ORDER BY table_name ASC;";
		$qry = "SELECT COUNT(*) FROM $tableName;";
		$this->customStatement($qry);
		return $this->returnedRows;
	}

} // end InteractDB class

?>