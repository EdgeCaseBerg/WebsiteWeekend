<?php
// session_start();
require_once 'Models/User.php';
require_once "Configuration/log.php";
require_once "Views/lib/CleanIn.php";
// logThis("testing");
session_start();
if(!isset($_SESSION['user'])){
	$user = new UserModel;
	$_SESSION['user'] = $user;
}
require 'Controllers/Controller.php';
