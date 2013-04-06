<?php
require_once "AbstractController.php";
class DefaultController extends AbstractController{
	private $POST;
	private $actions;
	private $view = "defaultView";

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
			foreach($children as $value){
				// as long as there are an equal number of methods and variables
				// do --> for every action perform the switch statement
				switch ($value){
					case "page":
						switch($actions['page']){
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
								$this->view = "Members";
								break;
							case "contact":
								//Grab the list of emails of who to talk to
								$dbWrapper = new InteractDB('select',array('tableName'=>'tblContactEmails'));
								$this->vars['emails'] = $dbWrapper->returnedRows;
								$this->view = "Contact";
								break;
							case "help":
								//Send em to the hours page
								header('/Hours/');
								break;
						}
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