<?php
require_once "AbstractController.php";
require_once "Models/Image.php";
require_once "Models/ImageBundle.php";
require_once "Models/Hours.php";
class DefaultController extends AbstractController{
	private $POST;
	private $actions;
	private $view = "defaultView";
	public $vars;

	function __construct($actions = null, $POST = null){
		require_once "Models/DefaultModel.php";
		$modelObj = new DefaultModel("defaultView");
		$this->vars['news'] = $modelObj->getVars();
		
		$imageBundle = new ImageBundle();
		$this->vars['galleria'] = $imageBundle->galleriaData();
		$this->POST = $POST;
	 	$this->actions = $actions;
	 	$this->parseAction($this->actions);

	 }

	function parseAction($actions = null){
		// takes the actions to be performed on the 
		// controller and perfomrs them if they exist
		if($actions != null){
			$children = array_keys($actions);
			$methods = array_values($actions);

			if(count($children) != count($methods)){
				// if there are a different number of actions than variables
				// throw an error
				// please add my functionality
			}else{
				foreach($children as $value){
					// as long as there are an equal number of methods and variables
					// do --> for every action perform the switch statement
					switch ($value){
						case "page":
							switch($actions['page']){
								case "lostPassword":
									$this->view = "LostPassword";
								break;
								case "Misc":
									$this->view = "Misc";
								break;
								case "login":
									$this->view = "Login";
									break; 
								case "calendar":
									$this->view = "Calendar";
									break;
								case "projects":
									$this->view = "Projects";
									break;
								case "members":
									header('Location: ' . BASEDIR . 'Member/');
									break;
								case "signup":
									$this->view = "Signup";
									break;
								case "contact":
									//Grab the list of emails of who to talk to
									$dbWrapper = new InteractDB('select',array('tableName'=>'tblContactEmails'));
									$this->vars['emails'] = $dbWrapper->returnedRows;
									$this->view = "Contact";
									break;
								case "help":
									//Send em to the hours page
									header('Location: '. BASEDIR . 'Hours/');
									break;
								default:
									require_once "Models/DefaultModel.php";
									$modelObj = new DefaultModel("defaultView");
									$this->vars['news'] = $modelObj->getVars();
									$hourObj = new Hours("");
									$this->vars['hours'] = $hourObj->getTodaysHours();
									
									break;
							}
						break;
						} // end switch
				} // end foreach
			} // end else
		} else {
			require_once "Models/DefaultModel.php";
			$modelObj = new DefaultModel("defaultView");
			$hourObj = new Hours();
			$this->vars['hours'] = $hourObj->getTodaysHours();
			$this->vars['news'] = $modelObj->getVars();
		}


	} // end parseAction()

	public function getView(){
		return $this->view;
	}

	public function getVars(){
		return $this->vars;
	}
}