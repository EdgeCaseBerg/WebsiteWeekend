
<?php

// Author: Joshua Dickerson
// Developed 2012 at The University of Vermont

// head controller class
// this class creates an instance of a router
// which parses the URL and delivers to the controller
// a path to a model file and an array of actions to operate
// on that model

// URLs look like /basedir/model/?action=doAction

require_once "Configuration/config.php";
require_once "Models/InteractDB.php";

// recieves the url, instanciates the appropriate controller -->
$controllerObj = new Controller($_SERVER, $_POST);

class Controller{
	private $routerObj;
	private $modelObj;
 	private $view ='Home';
 	private $vars = null;
 	private $POST;
 	private $SERVER;

 	// first thing the controller needs to do is fire up the router, which parses 
 	// the requested URL into its component parts 
 	function __construct(){
 		require_once "Controllers/View.php";
		require_once "Controllers/Router.php";
 		$this->POST = $_POST;	// grab all the $POST data for local use
 		$this->routerObj = new Router($_SERVER);
 		$_SESSION['user']->setCurrentDevice($this->routerObj->getDeviceType());
 		$this->getModelData();
 		$this->buildDisplay();

 	} // end construct

	private function buildDisplay(){
		$view = new View($this->view, $this->vars);
	}

 	// second thing is to create a new model object defined by the url/router
 	// we then get the applicable model data, and drop it into an array
	function getModelData(){

		// get data from the model, returns the model object
		// get array of model and action from the routerObj
		// if the router has created a controller instance, and that instance isn't empty?
		$controller = $this->routerObj->getController();
		logThis($controller);
		if(isset($controller) && $controller != ""){
			$controller = $controller."Controller";
			// if there is an associated controller, make an instance of that object
			// perform the requested action, and return the data, otherwise drop into 
			// the default model. 
			
			if(file_exists("Controllers/".$controller.".php")){ // check if a file exists in the controller dir
				logThis("********");
				include "Controllers/".$controller.".php";
				$controllerObj = new $controller($this->routerObj->getActions(), $this->POST);
				$this->view = $controllerObj->getView();
				if($controllerObj->getVars()){$this->vars = $controllerObj->getVars();}
			}else{	// a controller was called, but does not exist, send user to the default
			} // end nested if-else
		}
	} // end getModelData()

} // end Controller class

?>
