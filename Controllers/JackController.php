<?php
/** 
* JackController is the jack of all trades, used to get misc info from the datastore
*
*
**/
require_once "Controllers/AbstractController.php";
require_once "Models/Jack.php";
class JackController extends AbstractController{
private $POST;
 	private $actions = array();
 	private $view;
 	public $modelObj;
 	public $vars;

 	function __construct($actions = null, $POST = null){
		$this->POST = $POST;
	 	$this->actions = $actions;
	 	$this->modelObj = $_SESSION['user'];
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
					case "getMemberLangs":
						require_once "Models/Jack.php";
						$jack = new Jack();
						$this->vars = $jack->getMemberLangs();
					break;
					case "output":
						if($actions['output'] == "json"){
							$this->view = "json";
						}
					break;
					default;
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

	// generate a random string of chars
	public function generateRandomString($length = 20) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
} // end JackController classDef
?>