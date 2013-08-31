<?php
//$routerObj = new Router($_SERVER);
// var_dump($routerObj);
 class Router{
 	private $requestURL;
 	private $userAgent;
 	private $clientIP;
 	private $controller = false;
 	private $model = "default model requested";
 	private $action = array();


 	function __construct($serverRequest){
 		$this->clientIP	= $serverRequest['REMOTE_ADDR'];
 		$this->userAgent = $serverRequest['HTTP_USER_AGENT'];
 		$this->requestURL = $serverRequest['REQUEST_URI'];
 		$this->parseURL($serverRequest['REQUEST_URI']);
 		// var_dump($serverRequest['REQUEST_URI']);
 	}

 	function parseURL($requestURL){
 		// logThis($requestURL);
 		$requestArr = parse_url($requestURL);// takes the URL and parses it into an array indexed by (scheme, host, user, password, path, query) 		
 		$urlPath = explode("/", $requestArr['path']); //  this is for parsing urls like /users/ tells us which class we need
		if (isset($requestArr['query'])){
			$urlQuery = explode("&", $requestArr['query']); // this is for parsing urls like ?action=logout
			$numQuery = count($urlQuery);
		}
		$actionQueried = array();

		//iterate through our query, assigning actions to the action array
		if (isset($urlQuery)){
			foreach($urlQuery as $value){
				$splode = explode("=", $value);
				$actionQueried[$splode[0]] = $splode[1];
			}
		}


		// // the following trims the leading and following "/" off of the path
		// Live server
		// $dirTrim = str_replace("/~cscrew" ,"",$requestArr['path']);
		// $dirTrim = str_replace("/" ,"",$dirTrim);

		// localhost
		$dirTrim = str_replace(BASEDIR ,"",$requestArr['path']);
		
		// $dirTrim = str_replace("~cscrew" ,"",$requestArr['path']);
		// $dirTrim = str_replace(BASEDIR ,"",$requestArr['path']);
		// logThis($dirTrim);
		
		
		if(isset($urlPath[1+array_search($dirTrim, $urlPath)])){
			$ControllerQuery = $dirTrim;
			if(substr($ControllerQuery, -1) == "/"){
				substr_replace($dirTrim ,"",-1);
			}
			$this->controller = ucfirst(strtolower($ControllerQuery));
		}
				
		$this->action = $actionQueried;
	} // end parseURL


 	public function getDeviceType(){
 		$userAgent = $this->userAgent;
 	// this function tells us whether its a phone or not
 	// not sure if this should be in the router or the display
 		if(stristr($userAgent, 'mobile') || stristr($userAgent, 'android') || stristr($userAgent, 'iphone') || stristr($userAgent, 'ipod')){
 			return 2; // 2 is for phoneerialize() gets called or provide a __autoload() function to load the class definition  in /var/www/WebsiteWeekend/Controllers/Controller.php on line 36
 		}
 		else {
 			return 1; // 1 is for desktop
 		} 
 	}


 	/* getters and setters */
 	public function getController(){
 		if ($this->controller){
			return $this->controller;
		}else{return false;}
	} // end getController

 	public function getActions(){
 		if(isset($this->action)){
 			return $this->action;
 		}else{return false;} 
 	} // end getActions

 	public function getUserAgent(){
 		return $this->userAgent;
 	}

 	public function getUserIP(){
 		return $this->clientIP;
 	}

 	public function getRequestURL(){
 		return $this->requestURL;
 	}


}

?>
