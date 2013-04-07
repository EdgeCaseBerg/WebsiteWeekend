<?php

require_once "Controllers/AbstractController.php";
require_once "Models/Jack.php";
class UsagedataController extends AbstractController{
private $POST;
 	private $actions = array();
 	private $view;
 	public $modelObj;
 	public $vars;

 	function __construct($actions, $POST){
		$this->POST = $POST;
	 	$this->actions = $actions;
	 	$this->modelObj;
	 	$this->parseAction($this->actions);
	 }

	function parseAction($actions){
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
				logThis("GET");
			}
			foreach($children as $value){
				// as long as there are an equal number of methods and variables
				// do --> for every action perform the switch statement
				switch ($value) {
					case "data":
						require_once "Models/Usagedata.php";
						$usage = new Usagedata();
						if($actions['data'] == "visitsOverTime"){
							$this->view = "UsageGraph";
							$this->vars['graphData'] = $usage->usageOverTIme();
						}else if($actions['data'] == "purposeBar"){
							$this->view = "UsageGraph";
							$this->vars['graphData'] = $usage->purpose();
							$this->vars['graphType'] = "column";
						}else if($actions['data'] == "classBar"){
							$this->view = "UsageGraph";
							$this->vars['graphData'] = $usage->byClass();
						}
					break;
					case "output":
						if($actions['output']=="json"){
							$this->view = "json";
						}
					break;
				}
			}
		}
	} // end parseAction()

	public function getView(){
		return $this->view;
	}

	public function getVars(){
		return $this->vars;
	}
} // end JackController classDef
?>