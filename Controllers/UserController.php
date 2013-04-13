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
						if($_SESSION['user']->getUserID() != $actions['settings']){
							header("location: ".BASEDIR."Default/"); 
						}
						$this->vars = $_SESSION['user']->getProfile();
						$this->view = 'Editprofile';
					break;
					case "updateProfile":
						// if($_SESSION['user']->getUserAuth() > 0){
							$_SESSION['user']->updateProfile($this->POST);
						// }
					break;
					case "showUserProfile":
						// for outsiders seeing a user's profile
						require_once "Models/User.php";
						$user = new UserModel();
						$this->vars = $user->getProfile($actions['showUserProfile']);
						$this->view = "Profile";
					break;
					case "getProfile":
						$this->vars['userProfile'] = $_SESSION['user']->getProfile();
						// logThis($this->vars);
					break; 
					case "doLogin":
						require_once "Lib/recaptchalib.php";
						logThis("capta");
						$privatekey = "6Leq0N8SAAAAAOu25RDhsEdXFLkpCWmms2ekBuKW";
						if ($_POST["recaptcha_response_field"]) {
								logThis("inside post response capta");
								$resp = recaptcha_check_answer ($privatekey,
								$_SERVER["REMOTE_ADDR"],
								$_POST["recaptcha_challenge_field"],
								$_POST["recaptcha_response_field"]);
							if ($resp->is_valid) {
								$loginResult = $_SESSION['user']->login($this->POST['fldEmail'], $this->POST['fldPassword']);
								if($loginResult){
									logThis("login good");
									header('location: '.BASEDIR.'User/?home='.$_SESSION['user']->getUserID()); 
									exit;
								}else{
									logThis("login bad");
									// $_SESSION['notifications'] = "login Failed";
									header("location: ".BASEDIR."Default/?page=login"); 
									exit;
								}
							} else {
								# set the error code so that we can display it
								logThis("captcha bad");
								// $_SESSION['notifications'] = "login Failed";
								header("location: ".BASEDIR."Default/?page=login"); 
								exit;
							}
						}else{
							# set the error code so that we can display it
							logThis("captcha non-existent");
							// $_SESSION['notifications'] = "login Failed";
							header("location: ".BASEDIR."Default/?page=login"); 
							exit;
						}
					break;
					case "lostPassword":
						require_once "Lib/recaptchalib.php";
						$privatekey = "6Leq0N8SAAAAAOu25RDhsEdXFLkpCWmms2ekBuKW";
						if ($_POST["recaptcha_response_field"]) {
								$resp = recaptcha_check_answer ($privatekey,
								$_SERVER["REMOTE_ADDR"],
								$_POST["recaptcha_challenge_field"],
								$_POST["recaptcha_response_field"]);
							if ($resp->is_valid) {
								if(isset($_POST['fldEmail'])){
									$_SESSION['user']->lostPassword($_POST['fldEmail']);
								}else{
									# set the error code so that we can display it
									$_SESSION['notifications'] = "You forgot to enter your email";
									header("location: ".BASEDIR."Default/?page=lostPassword");
									exit;
								}
							} else {
								# set the error code so that we can display it
								$_SESSION['notifications'] = "Captcha Invalid";
								header("location: ".BASEDIR."Default/?page=lostPassword");
								exit;
							}
						}else{
							$_SESSION['notifications'] = "Please complete the captcha";
							header("location: ".BASEDIR."Default/?page=lostPassword"); 
							exit;
						}
					break;
					case "newUser":
					require_once "Lib/recaptchalib.php";
						logThis("capta");
						$privatekey = "6Leq0N8SAAAAAOu25RDhsEdXFLkpCWmms2ekBuKW";
						if ($_POST["recaptcha_response_field"]) {
								logThis("inside post response capta");
								$resp = recaptcha_check_answer ($privatekey,
								$_SERVER["REMOTE_ADDR"],
								$_POST["recaptcha_challenge_field"],
								$_POST["recaptcha_response_field"]);
							if ($resp->is_valid) {
								$loginResult = $_SESSION['user']->login($this->POST['fldEmail'], $this->POST['fldPassword']);
						    	if($_SESSION['user']->newUser($this->POST)){
						    		$this->view = "Login";
						    		$_SESSION['notifications'] = "Please log into your new account";
						    	}else{
						    		$this->view = "Signup";
						    		$_SESSION['notifications'] = "That username is already in use";
						    	}
						    }else{
						    	$this->view = "Signup";
						    		$_SESSION['notifications'] = "captcha failed";
						    }
						}else{
							$this->view = "Signup";
						    $_SESSION['notifications'] = "Don't forget to enther the captcha!";
						}
					break;
					case "output":
						if($actions['output'] == "json"){
							$this->view = "json";
						}
					break;
					case "resetPassword":
					// the reset password link has been clicked
						if(isset($actions['resetPassword']) && isset($_GET['emailAddr']){
							// check for a row where hash and email address coincicide
							$userHash = $actions['resetPassword'];
							$email = $_GET['emailAddr'];
							$array = array(
								'tableName'=>'tblUserAccount',
								'fldEmail'=>$email,
								'fldLostPasswordHash'=>$userHash
							);
							$dbWrapper = new InteractDB('select', $array);
							if (count($dbWrapper->returnedRows) == 1){
								// there was a match for the hash and for the email address
								$this->vars['lostEmail'] = $email;
								$this->vars['lostEmailHash'] = $userHash;
								$this->view = "resetPassword"; 
							}
						}
					break;
					case "completeResetPassword":
						// verify that the password and email has been properly posted
						if(isset($_POST['fldPassword']) && isset($_POST['validEmail']) && isset($_POST['lostEmailHash'])){
							// update our db with the new password
							$query = "UPDATE tblUserAccount SET fldLostPasswordHash=null, ";
							$query .= "fldPassword=".$_POST['fldPassword']." WHERE fldEmail=";
							$query .= $_POST['validEmail']." AND fldLostPasswordHash=".$_POST['lostEmailHash'];
							$dbWrapper = new InteractDB();
							$dbWrapper->customStatement($query);
						}else{
							// if we got invalid info, drop to the default
							header("location: ".BASEDIR."Default/"); 
							exit;
						}
					break;
					case "logOut":
						$_SESSION['user']->logout();
						header("location: ".BASEDIR."Default/"); 
						exit;
					break;
					default:
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
