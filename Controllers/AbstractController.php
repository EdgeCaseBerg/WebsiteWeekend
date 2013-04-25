<?php

abstract class AbstractController{
	private $POST;
	private $actions;
	private $view;
	public  $vars;


	abstract function parseAction($actions);
	abstract function getView();
	abstract function getVars();
}