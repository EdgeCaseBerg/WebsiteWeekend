<?php
// session_start();
require_once 'Models/User.php';
require_once "Configuration/log.php";
<<<<<<< HEAD
=======

require_once "Views/lib/CleanIn.php";

>>>>>>> 54a5613ce8d32c7cb12e1f572ed1706030b84340
session_start();
if(!isset($_SESSION['user'])){
	$user = new UserModel;
	$_SESSION['user'] = $user;
}
require 'Controllers/Controller.php';
