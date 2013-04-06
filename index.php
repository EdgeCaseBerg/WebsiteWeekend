<?php
// session_start();
require_once 'Models/User.php';
require_once "Configuration/log.php";
// logThis("working");
session_start();
if(!isset($_SESSION['user'])){
	$user = new UserModel;
	$_SESSION['user'] = $user;
}
require 'Controllers/Controller.php';
