<?php
require_once "AbstractController.php";
class ErrorController extends AbstractController{
 	private $POST;
 	private $actions = array();
 	private $view;
 	public $modelObj;
 	public $vars;
 	private $captcha = false;

 	function __construct($actions, $POST){
		$this->POST = $POST;
	 	$this->actions = $actions;
	 	$this->parseAction($this->actions);
	 }

	function parseAction($actions){
		$this->view = 'fail';
	} // end parseAction()

	public function getView(){
		return $this->view;
	}

	public function getVars(){
		return $this->vars;
	}

} // end User class


?>
