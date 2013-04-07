<?php
require_once "AbstractController.php";
class TestController extends AbstractController{
	private $POST;
	private $actions;
	private $view;

	function __construct($actions, $POST){
logThis("inside TestController");
		$this->POST = $POST;
	 	$this->actions = $actions;
	 	$this->parseAction($this->actions);
	}

	public function parseAction($actions){
		// takes the actions to be performed on the 
		// controller and perfomrs them if they exist
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
					case "database":
						$dbWrapper = new InteractDB();
						$this->vars['dbObj'] = $dbWrapper;
						$this->view = "Systemtest";
					break;
					default;
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
