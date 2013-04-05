<?php
logThis("included");	
require_once "AbstractController.php";

class RoomSignInController extends AbstractController{
	private $POST;
	private $actions;
	private $view;

	function __construct($actions, $POST){
		$this->POST = $POST;
	 	$this->actions = $actions;
	 	$this->parseAction($this->actions);
	}

	public function parseAction($actions){
		// takes the actions to be performed on the 
		// controller and perfomrs them if they exist
		logThis("ASDSA");
		$children = array_keys($actions);
		$methods = array_values($actions);
		if(count($children) != count($methods)){
			// if there are a different number of actions than variables
			// throw an error
			// please add my functionality
		}
		else{
			foreach($children as $value){
				// as long as there are an equal number of methods and variables
				// do --> for every action perform the switch statement
				switch ($value){
					case "login":
						$this->vars['thing'] = $value;
						$this->view = "RoomSignIn";
					break;
					default:
						//Default catchs a regular GET request to this page:
						$this->view = "RoomSignIn";
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