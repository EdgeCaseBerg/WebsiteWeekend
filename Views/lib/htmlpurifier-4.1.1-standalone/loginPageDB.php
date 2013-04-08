<?php
/**********************************/
/* Subclass of SQL_Connector 
/* Ethan Eldridge.  May 23rd 2012
/* Subclass of SQL connector designed to
/* provide specific functionality to the
/* login page
/* We make the assumption of running on
/* our database where we have mysql installed
************************************/

//We require some database access, which are conventiantly stored in a configuration file
//much better than reading and parsing a file for the options, even if doing so provides
//a non-programmer to changes things easily, since this site will be maintened hopefully
//by semi competetant people when we're done I think it's aright.
require_once('../Configuration/config.php')

class loginPageDB extends SQL_Connector {
	//This is a singleton class for speed and memory
	private static $singleInstance;

	//The constructor is inherited from the SQL_Connector

	public function __destruct(){
		//Destructor to ensure disconnection from database
		parent::__destruct();
	}

	public static function getInstance(){
		//Creates an instance if none exists, otherwise it returns the singleton
		if (!self::$singleInstance)
		{
			self::$singleInstance = new loginPageDB();
		}
		return self::$singleInstance;
	}

	public function connect_to_db(){
		//Connects to the data base using the info stored in configuration files
		//Fun Fact: @ suppresses errors of the expression it prepends
		
		//Connect to the database and select the database			
		try{
			$this->connection = new PDO("mysql:host=$DATABASE_HOST;dbname=DATABASE_NAME", DATABASE_USER, DATABASE_PASS);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $err){
			die('Could not connect to database' . $err->getMessage());
		}		
	}

	public function getClassList(){
		//make sure we have a connection first!
		if(!isset($this->connection)){
			die('You must set a database connection before calling functions that use the database!');
		}
		//Prepare the query!
		$statement = $this->connection->prepare("SELECT * FROM login_class ORDER BY pkNumber ASC WHERE Semester = ?" );
		//The $SEMESTER variable comes from config.php
		$statement->bindValue(1, $SEMESTER, PDO::PARAM_STR);
		//Actually query and return an array
		$statement->execute();
		$class_list = $statement->fetchAll();
		
		//Now create a list of strings to return that will be outputed
		$class_array = array();
		foreach ($class_list as $class) {
			$class_array[] = 'CS '.$class['pkNumber'] . ' ' . $class['ClassName'] . ' (' . $class['Instructor'] . ')';
		}

		return $class_array;

	}
}
//Some test code
echo "making class\n </br>";
$testd = loginPageDB::getInstance();
echo "attempting to connect\n </br>";
$dbc = $testd->connect_to_db();
$query = "SELECT pkPersonID, FirstName, LastName, StartTime, EndTime
			FROM R332_Person
			Inner Join R332_Hours on pkPersonID = fkPersonID
			WHERE DayOfWeek= '". $shortDay ."' AND Semester='" . $semester . "' AND Active =1 
			ORDER BY StartTime ASC";		
$result = $testd->query($query);	
echo $result;
var_dump($testd->getClassList());
$testd->close_connection_to_db();
?>