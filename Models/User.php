<?php

class UserModel{
	private $userName = null;
	private $userID = null;
	private $userEmail = null;
	private $userAuth;
	private $userLastLogin;
	private $userLoggedIn = false;
	private $view;
	// desktop = 1, phone = 2, tablet = 3;
	private $currentDevice = 1;


	// login(username, password) sets this userLoggedIn property to true 
	// if credentials are matched, and then returns true. 
	// returns false if credentials don't match
	public function login($username, $password){
		$salt = time()*0.118321;
	 	// $password = md5($password, $salt);
	 	$array = array('tableName'=>'tblUserAccount', 'fldUsername'=>$username);
	 	$dbWrapper = new InteractDB('select', $array);
	 	// logThis($dbWrapper);
	 	if(isset($dbWrapper->returnedRows[0]['fldPassword']) && $dbWrapper->returnedRows[0]['fldPassword'] == $password){
	 		$this->setUserLoggedIn(true);
			$this->setUserAuth($dbWrapper->returnedRows[0]['fldAuth']);
			$this->setUserID($dbWrapper->returnedRows[0]['pkUserID']);
			$this->setUserEmail($dbWrapper->returnedRows[0]['fldEmail']);
			$this->setUserLastLogin();
			return true;
		}else{
			return false;
		}

	} // end logIn

	public function getProfile(){
		$array = array(
			'tableName'=>'tblUserProfile',
			'fkUserID'=>$_SESSION['user']->getUserID()
		);
		$dbWrapper = new InteractDB('select', $array);
		return $dbWrapper->returnedRows[0];
	} // end getProfile

	public function updateProfile($POST){
		// get our current row
		$array = array(
			'tableName'=>'tblUserProfile',
			'fkUserID'=>$_SESSION['user']->getUserID()
		);
		$dbWrapper = new InteractDB('select', $array);

		// begin prepping our new entry
		$array = array(
			'tableName'=>'tblUserProfile',
			'fldFirstName'=>$POST['first_name'],
			'fldLastName'=>$POST['last_name'],
			'fldPersonalURL'=>$POST['personal_url'],
			'fldAboutMe'=>$POST['about_me'],
			'fldGitURL'=>$POST['git'],
			'fldTwitterURL'=>$POST['twitter'],
			'fldFacebookURL'=>$POST['facebook'],
			'fldTumblrURL'=>$POST['tumblr'],
			'fldLinkedinURL'=>$POST['linkedin'],
			'fldGoogleURL'=>$POST['google']
		);

		// if we uploaded a user image
		logThis($_FILES);
		if($_FILES["userIMG"]["tmp_name"] != "" && $_FILES["userIMG"]["tmp_name"] != null){
			if($_FILES["userIMG"]["type"] == "image/jpeg"){$ext = ".jpg";}
			if($_FILES["userIMG"]["type"] == "image/png"){$ext = ".png";}
			if($_FILES["userIMG"]["type"] == "image/gif"){$ext = ".gif";}
			move_uploaded_file($_FILES["userIMG"]["tmp_name"], "Views/images/profile_images/" ."user_id_".$_SESSION['user']->getUserID().$ext);
			$array['fldProfileImage'] = "user_id_".$_SESSION['user']->getUserID().$ext;
		}
		if(count($dbWrapper->returnedRows)<1){
		// a row doesn't exist for this person, make a new one
			$array['fkUserID'] = $_SESSION['user']->getUserID();
			$dbWrapper = new InteractDB('insert', $array);
		}else{
		// update the existing row
			$array['tableKeyName'] ='fkUserID';
			$array['tableKey'] = $_SESSION['user']->getUserID();
			$dbWrapper = new InteractDB('update', $array);
		}
		header('location: '.BASEDIR.'User/?settings='.$_SESSION['user']->getUserID()); 
	} // end updateProfile()

	public function logout(){
		unset($_SESSION);
		session_destroy();
		$this->setUserLoggedIn(false);
	} // end logout

	// getters and setters
	public function getView(){
		return $this->view;
	}
	public function setCurrentDevice($int){
		$this->currentDevice = $int;
	} // end setCurrentDevice

	public function getCurrentDevice(){
		return $this->currentDevice;
	} // end getCurrentDevice

	public function getUserName(){
		return $this->userName;
	} // end getUserName

	public function getUserID(){
		return $this->userID;
	} // end getUserID

	public function setUserID($userID){
		$this->userID = $userID;
	} // end setUserID

	public function getUserEmail(){
		return $this->userEmail;
	} // end getUserEmail

	public function setUserEmail($userEmail){
		$this->userEmail = $userEmail;
	} // end setUserEmail

	public function getUserLastLogin(){
		return $this->userLastLogin;
	} // end getUserLastLogin

	public function setUserLastLogin(){
		$this->userLastLogin = time();
	} // end setUserLastLogin

	public function getUserLoggedIn(){
		return $this->userLoggedIn;
	} // end getUserLoggedIn

	public function setUserLoggedIn($bool){
		$this->userLoggedIn = $bool;
	} // end setUserLoggedIn

	public function getUserAuth(){
		return $this->userAuth;
	} // end getUserLoggedIn

	public function setUserAuth($int){
		$this->userAuth = $int;
	} // end setUserLoggedIn

} // end class User