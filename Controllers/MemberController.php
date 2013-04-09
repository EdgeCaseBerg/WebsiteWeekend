<?php
require_once "AbstractController.php";
require_once "Models/Member.php";

class MemberController extends AbstractController{
	private $POST;
	private $actions;
	private $view='Members';

	function __construct($actions, $POST){
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
			if(count($children)==0){
				$children = array('something' => '');
			}
			foreach($children as $value){
				// as long as there are an equal number of methods and variables
				// do --> for every action perform the switch statement
				switch ($value){
					default:
						//Get active members to display
						$dbWrapper = new InteractDB();
						$modelObj = new Member('');
						$this->vars['members'] = $modelObj->getMembers(0,1000);
						$this->view = "Members";
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
