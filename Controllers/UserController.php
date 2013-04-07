<?php
require_once "AbstractController.php";

class UserController extends AbstractController{
 	private $POST;
 	private $actions = array();
 	private $view;
 	public $modelObj;
 	public $vars;

 	function __construct($actions, $POST){
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
					case "home":
						$this->view = 'Profile';
					break;
					case "settings":
						$this->view = 'Editprofile';
					break;
					case "updateProfile":
						$_SESSION['user']->updateProfile($this->POST);
					break;
					case "getProfile":
						$this->vars = $_SESSION['user']->getProfile();
						// logThis($this->vars);
					break; 
					case "doLogin":
						logThis("in dologin");
					    $loginResult = $_SESSION['user']->login($this->POST['fldUsername'], $this->POST['fldPassword']);
					    if($loginResult){
					    	// if login worked redirect the user to his home page
					    	logThis("login good");
					    	header('location: '.BASEDIR.'User/?home='.$_SESSION['user']->getUserID()); 
					    	exit;
					    }else{
					    	logThis("login bad");
					    	// $_SESSION['notifications'] = "login Failed";
					    	header("location: ".BASEDIR."Default/"); 
					    	exit;
					    }
				    break;
				    case "newUser":
				    	if($_SESSION['user']->newUser($this->POST)){
				    		$this->view = "Editprofile";
				    	}else{
				    		$this->view = "Signup";
				    		$this->vars['notifications'] = "That username is already in use";
				    	}
				    break;
				    case "output":
				    	if($actions['output'] = "json"){
				    		$this->view = "json";
				    	}
				    break;
				    case "logOut":
				    	$_SESSION['user']->logout();
				    	header("location: ".BASEDIR."Default/"); 
					    exit;
				    break;
				    default:
				       // echo "i is not equal to 0, 1 or 2";
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

} // end User class


?>
