<?php

abstract class AbstractController{
	private $POST;
	private $actions;
	private $view;


	abstract function parseAction($actions);
	abstract function getView();
	abstract function getVars();
}