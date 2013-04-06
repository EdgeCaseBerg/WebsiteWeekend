<?php
require_once "AbstractController.php";
require_once "Models/Hours.php";

class HoursController extends AbstractController{
	private $POST;
	private $actions;
	private $view = 'Hours';
	private $modelObj;

	function __construct($actions, $POST){
		$this->POST = $POST;
	 	$this->actions = $actions;
	 	$this->modelObj = new Hours($this->view);
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
				//Regular old get request
				$children = array('default'=>'getmemystuffplease');
			}
			foreach($children as $value){
				// as long as there are an equal number of methods and variables
				// do --> for every action perform the switch statement

				switch ($value){
					case "expertise":
						if($actions['expertise']=="Show+all"){
							$this->vars['hours'] = $this->modelObj->getAllHours();
						}else{
							//Do a search by the expertise
						}
						$this->vars['hours'] = $this->modelObj->getAllHours();
						$this->vars['languages'] = $this->modelObj->getLanguages();
						$this->view = "Hours";
					break;
					default:
						logThis($this->vars);
						$this->vars['hours'] = $this->modelObj->getAllHours();
						$this->vars['languages'] = $this->modelObj->getLanguages();
						$this->view = "Hours";
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