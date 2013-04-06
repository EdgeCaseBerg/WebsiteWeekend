<?php
require_once "AbstractController.php";
require_once "Models/NewsModel.php";

class NewsController extends AbstractController{
	/*
		NewsController class
		Used to handle requests for /News, which will include requests for all of the news stories,
		or requests for specific news stories. 
	*/
	private $POST;
	private $actions;
	private $view;
	private $vars;

	function __construct($actions =null, $POST=null){
		/*
			Default constructor
			Sets post and action variables, as well as calls the parse action method to pull out each
			argument passed in via url.
		*/
		$this->POST = $POST;
	 	$this->actions = $actions;
	 	$this->parseAction($this->actions);
	}

	public function parseAction($actions){
		/*
			parseAction method
			takes the actions to be performed by the controller, and performs them if they exist.
		*/
		$children = array_keys($actions);
		$methods = array_values($actions);

		if(count($children) != count($methods)){
			// if there are a different number of actions than variables
			// throw an error
			// please add my functionality
		}
		else{
			foreach($children as $value){
				// as long as there are an equal number of methods and variables
				// do --> for every action perform the switch statement
				switch ($value){
					// if the request is for the main page, then render all of the news stories regularly
					case "allStories":
						// calls to the database to get all of the stories
						// $this->vars['helloObj'] = "Hello there";
						$modelObject = new NewsModel;
						$this->vars = $modelObject->retrieveAllStories();
						logThis($this->vars);
						$this->view = "NewsView";
						break;
					case "singleStory":
					// handle if it is a specific story requested, which means they've clicked on a 'full story' link
						$this->view = "NewsView";
						break;
					default;
				}
			}
		}
	}

	public function getView(){
		return $this->view;
	}

	public function getVars(){
		return $this->vars;
	}
}
