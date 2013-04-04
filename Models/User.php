<?php

class UserModel{
	private $userName;
	private $userID;
	private $userEmail;
	private $userAuth;
	private $userLastLogin;
	private $userLoggedIn = false;
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

	public function logout(){
		unset($_SESSION);
		session_destroy();
		$this->setUserLoggedIn(false);
	} // end logout

	// getters and setters
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