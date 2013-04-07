<?php
/**
* @author Joshua Dickerson at The University of Vermont
* The UserModel class represents the attributes and 
* methods associated with user
**/
require_once "Views/lib/CleanIn.php";
class UserModel{
	private $userName = null;
	private $userID = null;
	private $userEmail = null;
	private $userAuth;
	private $userLastLogin;
	private $userLoggedIn = false;
	private $view;
	private $currentDevice = 1;
	private $cleaner; // holds the sanitizer object

	function __construct(){
		$this->cleaner = new CleanIn();
	}

	// perform a login, return a boolean
	public function login($username, $password){
		require_once "Models/Bcrypt.php";
		$bcrypt = new Bcrypt(15);
	 	// $password = md5($password, $salt);
	 	$array = array('tableName'=>'tblUserAccount', 'fldUsername'=>$username);
	 	$dbWrapper = new InteractDB('select', $array);
	 	// logThis($dbWrapper);
	 	if(isset($dbWrapper->returnedRows[0]['fldPassword']) && $bcrypt->verify($password, $dbWrapper->returnedRows[0]['fldPassword'])){
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

	public function newUser($POST){
		require_once "Models/Bcrypt.php";

		$username = $POST['fldUsername'];
		$password = $POST['fldPassword'];
		$cleanUsername = $this->cleaner->clean($username);
		$cleanPassword = $this->cleaner->clean($password);
		$bcrypt = new Bcrypt(15);
		$cleanPassword = $bcrypt->hash($cleanPassword);
		$array = array(
			'tableName'=>'tblUserAccount',
			'fldUsername'=>$cleanUsername
		);
		$dbWrapper = new InteractDB('select', $array);
		if(count($dbWrapper->returnedRows) == 0){
			$array = array(
				'tableName'=>'tblUserAccount',
				'fldPassword'=>$cleanPassword,
				'fldAuth'=>1,
				'fldUsername'=>$cleanUsername
			);
			$dbWrapper = new InteractDB('insert', $array);
			return true;
		}else{
			return false;
		}
	}

	// retrieves user data from the database, returns it as an array
	public function getProfile($uid = null){
		if($uid != null){
			$array = array(
				'tableName'=>'tblUserProfile',
				'fkUserID'=>$uid
			);
		}else{
			$array = array(
				'tableName'=>'tblUserProfile',
				'fkUserID'=>$_SESSION['user']->getUserID()
			);
		}
		$dbWrapper = new InteractDB('select', $array);
		$returnArr['profile'] = $dbWrapper->returnedRows[0];
		$returnArr['langs'] = $this->getUserLangs(12);
		require_once "Models/Jack.php";
		$jack = new Jack();
		$returnArr['memberLangs'] = $jack->getMemberLangs();
		return $returnArr;
	} // end getProfile

	// called when a user updates their profile
	public function updateProfile($POST){
		// initialize the input sanitizer
		logThis($POST);
		$this->cleaner = new CleanIn();
		// get the current user profile
		$array = array(
			'tableName'=>'tblUserProfile',
			'fkUserID'=>$_SESSION['user']->getUserID()
		);
		$dbWrapper = new InteractDB('select', $array);

		// update our user expertise (langs)
		$qry = "DELETE FROM tblExpertise WHERE fkUserID = ".$this->userID.";";
		$dbWrapper->customStatement($qry);
		if(isset($POST['langs'])){
			$langsArr = $POST['langs'];
			for($ii=0; $ii<count($langsArr); $ii++){
				$query = "INSERT IGNORE INTO tblExpertise (fkUserID, fkLangID) VALUES (";
				$query .= $this->userID.", ".$langsArr[$ii].");";
				// $dbWrapper = new InteractDB();
				$dbWrapper->customStatement($query);
			}
		}
		// begin prepping our new entry
		// because we fill all the inputs with data from
		// the database, we can use the POSTed values to overwrite existing
		// values. if the user changed nothing, the value will be overwritten with the
		// previous value
		$array = array(
			'tableName'=>'tblUserProfile',
			'fldFirstName'=>$this->cleaner->clean($POST['first_name']),
			'fldLastName'=>$this->cleaner->clean($POST['last_name']),
			'fldPersonalURL'=>$this->cleaner->clean($POST['personal_url']),
			'fldAboutMe'=>$this->cleaner->clean($POST['about_me']),
			'fldGitURL'=>$this->cleaner->clean($POST['git']),
			'fldTwitterURL'=>$this->cleaner->clean($POST['twitter']),
			'fldFacebookURL'=>$this->cleaner->clean($POST['facebook']),
			'fldTumblrURL'=>$this->cleaner->clean($POST['tumblr']),
			'fldLinkedinURL'=>$this->cleaner->clean($POST['linkedin']),
			'fldGoogleURL'=>$this->cleaner->clean($POST['google'])
		);

		// if we uploaded a user image
		if($_FILES["userIMG"]["tmp_name"] != "" && $_FILES["userIMG"]["tmp_name"] != null){
			// set our extension for building our file name
			if($_FILES["userIMG"]["type"] == "image/jpeg"){$ext = ".jpg";}
			if($_FILES["userIMG"]["type"] == "image/png"){$ext = ".png";}
			if($_FILES["userIMG"]["type"] == "image/gif"){$ext = ".gif";}
			// sanitize that fucker
			if($this->cleaner->validateImage($_FILES["userIMG"]["tmp_name"])){
				move_uploaded_file($_FILES["userIMG"]["tmp_name"], "Views/images/profile_images/" ."user_id_".$_SESSION['user']->getUserID().$ext);
				$array['fldProfileImage'] = "user_id_".$_SESSION['user']->getUserID().$ext;
			}
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
		// send the user back to his/her profile page
		header('location: '.BASEDIR.'User/?settings='.$_SESSION['user']->getUserID()); 
	} // end updateProfile()

	// kill our user object
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

	public function getUserLangs($userID = null){
		// ned a join between tblExpertise and tblLanguages
		$qryID = $userID != null ? $userID : $this->userID;
		$query = "SELECT tblLanguages.language FROM tblLanguages LEFT";
		$query .= " JOIN tblExpertise ON tblLanguages.pkID = ";
		$query .= "tblExpertise.fkLangID WHERE tblExpertise.fkUserID = '".$qryID."';";
		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement($query);
		// logThis($dbWrapper->returnedRows);
		$langs = array();
		for($ii=0; $ii<count($dbWrapper->returnedRows); $ii++){
			$langs[$ii] = $dbWrapper->returnedRows[$ii];
		}
		return $langs;
	} // end getUserLangs()

	public function setUserLangs($LangsArray){
		// $this->userLangs; 
	} // end setUserLoggedIn

} // end class User