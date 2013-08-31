<?php
require_once "AbstractController.php";
require_once "Models/RoomSignIn.php";

class RoomSignInController extends AbstractController{
	private $POST;
	private $actions;
	private $view = 'RoomSignIn';
	private $modelObj;


	function __construct($actions = null, $POST = null){
		$this->POST = $POST;
	 	$this->actions = $actions;
	 	$this->modelObj = new RoomSignIn($this->view);
	 	$this->parseAction($this->actions);

	}

	public function parseAction($actions){
// 		// takes the actions to be performed on the 
// 		// controller and perfomrs them if they exist
		$children = array_keys($actions);
		$methods = array_values($actions);
		if(count($children) != count($methods)){
			// if there are a different number of actions than variables
			// throw an error
			// please add my functionality
		}
		else{
			//This does not handle no arguments.
			if(count($children)==0){
				$children = array('default' => '');
			}
			foreach($children as $value){
// 				// as long as there are an equal number of methods and variables
// 				// do --> for every action perform the switch statement
				switch ($value){
					case "login":
						//Attempt to do the login
						//Are they a uvm student?
						$uvmInfo = $this->getUVMUserInfo($this->POST['uvm_id']);
						if(is_array($uvmInfo)){
							$this->POST['class'] = $uvmInfo['class'];
						}else{
							//Not a valid uvm if
							$this->vars['errors']['uvm'] = "Not a valid UVM Id";
						}
						if($this->POST['purpose'] == -1){
							//Invalid purpose
							$this->vars['errors']['purpose'] = "Please select your purpose";
						}
						//if there's no errors and give them a nice good job message
						if(!isset($this->vars['errors'])){
							//Log the usage of the room.
							$this->modelObj->logUsage($this->POST);
							$this->vars['success'] = 'yes';
						}
						$this->view = "RoomSignIn";
						$this->vars['purposes'] = $this->modelObj->getPurpose();	
						break;
					default:
						//Display the sign in page
						$this->view = "RoomSignIn";
						$this->vars['purposes'] = $this->modelObj->getPurpose();
						break;
				}
			}
		}
	}

	public function getUVMUserInfo( $userName ) {
		$info = $this->useLDAP( $userName ); 
		
		if( is_array($info) ) {
			$first = $info[0]["givenname"][0] ;
			$last =  $info[0]["sn"][0];
			$email =  $info[0]["mail"][0];
			$class =  $info[0]["ou"][0];
			
			$output = array( "uid"=>$userName, "fname"=>$first, "lname"=>$last, "email"=>$email, "class"=>$class );
			
			return $output;
		}
		
		//If we get here then we got nothing back and they're not a student
		return false;
	}
	
	private function useLDAP( $uvmID ) {	
		//Connects to the ldap server
		$ds = ldap_connect( "ldap.uvm.edu" );

		//if connection is successful
		if( $ds ) {               
			$r=ldap_bind( $ds );
			$dn = "uid=$uvmID,ou=People,dc=uvm,dc=edu";
			$filter="( | ( netid=$uvmID ) )";

			$findthese = array( "sn", "givenname", "mail", "ou" );
//			$findthese = array();

			if( $searchResults = @ldap_search( $ds, $dn, $filter, $findthese ) ) {
				// if there are more than 0 results
				if( ldap_count_entries( $ds, $searchResults ) > 0 ) {
					$info = ldap_get_entries( $ds, $searchResults );				
					ldap_close( $ds );				
					return $info;
				} else {
					return "Invalid UVM Net Id.";
				}
			}
		}
		ldap_close( $ds );
		return "Invalid UVM Net Id.";
	}

	public function getView(){
		return $this->view;
	}

	public function getVars(){
		return $this->vars;
	}
}