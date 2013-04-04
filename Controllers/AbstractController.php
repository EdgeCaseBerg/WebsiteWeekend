<?php

abstract class AbstractController{
	private $POST;
	private $actions;
	private $view;


	private abstract function parseAction($actions){
	}

	public abstract function getView(){
	}

	public abstract function getVars(){
	}
}