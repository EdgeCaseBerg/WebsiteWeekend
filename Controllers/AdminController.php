<?php
require_once "AbstractController.php";
class AdminController extends AbstractController{
	private $POST;
	private $actions;
	private $view;
	public $vars;

	public function __construct($actions, $POST){
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
			logThis($methods);
			foreach($children as $value){
				// as long as there are an equal number of methods and variables
				// do --> for every action perform the switch statement
				switch ($value){
					case "news":
						switch($actions['news']){
							case "new":
								break;
							case  "edit";

								break;
							default:
								break;
						}
						$this->view = "defaultView";
					break;

					case "users":
						break;

					case "resources":
						break;

					default;
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

?>

