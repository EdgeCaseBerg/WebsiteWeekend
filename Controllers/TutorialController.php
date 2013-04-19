<?php
require_once "AbstractController.php";
require_once "Models/Tutorial.php";
require_once "Views/lib/CleanIn.php";

class TutorialController extends AbstractController{
	private $POST;
	private $actions;
	private $view = 'Tutorial';
	private $modelObj;

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
				//Regular old get request
				$children = array('default'=>'getmemystuffplease');
			}
			foreach($children as $value){
				// as long as there are an equal number of methods and variables
				// do --> for every action perform the switch statement

				switch ($value){
					case 'add':
						//Clean everything...
						$cleaner = new CleanIn();
						$url = urlencode($_POST['url']);
						$title = str_replace( "'",'', $cleaner->clean($_POST['title']));
						logThis($title);
						$modelObj = new Tutorial($this->view);
						$modelObj->addTutorial($url,$title);
						//No break, fall into default
					default:
						$this->view = "Tutorial";
						$modelObj = new Tutorial($this->view);
						$this->vars['tutorials'] = $modelObj->getTutorials();
						logThis($this->vars['tutorials']);
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