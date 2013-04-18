<?php
require_once "AbstractController.php";
require_once "Models/Projects.php";

class ProjectsController extends AbstractController{
	private $POST;
	private $actions;
	private $view = "Projects";

	function __construct($actions = null, $POST = null){
		$this->POST = $POST;
	 	$this->actions = $actions;
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
		}else{
			if(count($children)==0){
				$children = array('please' => 'do me'); //Do me as in do the loop below here... perv
			}
			foreach($children as $value){
				// as long as there are an equal number of methods and variables
				// do --> for every action perform the switch statement
				switch ($value){
					default:
						$modelObj = new Projects($this->view);
						$this->vars['projects'] = $modelObj->getProjects();
						break;
					} // end switch
			} // end foreach
		} // end else

	} // end parseAction()

	public function getView(){
		return $this->view;
	}

	public function getVars(){
		return $this->vars;
	}
}