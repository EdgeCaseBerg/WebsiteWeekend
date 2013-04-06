<?php
require_once "AbstractController.php";
require_once "Models/RoomSignIn.php";

class RoomSignInController extends AbstractController{
	private $POST;
	private $actions;
	private $view = 'RoomSignIn';
	private $modelObj;


	function __construct($actions = null, $POST = null){
		$this->POST = $POST;
	 	$this->actions = $actions;
	 	$this->modelObj = new RoomSignIn($this->view);
	 	$this->parseAction($this->actions);

	}

	public function parseAction($actions){
// 		// takes the actions to be performed on the 
// 		// controller and perfomrs them if they exist
		$children = array_keys($actions);
		$methods = array_values($actions);
		if(count($children) != count($methods)){
			// if there are a different number of actions than variables
			// throw an error
			// please add my functionality
		}
		else{
			//This does not handle no arguments.
			if(count($children)==0){
				$children = array('default' => '');
			}
			foreach($children as $value){
// 				// as long as there are an equal number of methods and variables
// 				// do --> for every action perform the switch statement
				switch ($value){
					case "login":
						//Attempt to do the login
						$this->view = "RoomSignIn";
						$this->vars['purposes'] = $this->modelObj->getPurpose();
						logThis($_POST);
						break;
					default:
						//Display the sign in page
						$this->view = "RoomSignIn";
						$this->vars['purposes'] = $this->modelObj->getPurpose();
						break;
				}
			}
		}
	}

	public function getView(){
		return $this->view;
	}

	public function getVars(){
		return $this->vars;
	}
}