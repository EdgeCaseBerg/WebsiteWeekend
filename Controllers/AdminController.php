<?php
require_once "AbstractController.php";
require_once "Models/News.php";
require_once "Models/NewsBundle.php";

class AdminController extends AbstractController{
	private $POST;
	private $actions;
	private $view;
	public $vars;

	public function __construct($actions, $POST){
		$this->POST = $POST;
	 	$this->actions = $actions;
	 	$this->parseAction($this->actions);
	}

	public function parseAction($actions){
		// takes the actions to be performed on the 
		// controller and perfomrs them if they exist
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
					case "news":
						switch($actions['news']){
							case "new":
								$this->view = "AdminViews/newStory";
								$newsBundle = new NewsBundle();
								$news = $newsBundle->retrieveAll();
								foreach($news as $story){
									error_log(print_r($story->toArray(),true));
								}
								break;
							case  "edit":
								if(isset($_GET['id'])){
									$news = new News();
									$news->initById($_GET['id']);
									$this->vars['news'] = $news->toArray();
									$this->vars['file_text'] = file_get_contents('Views/Stories/Content/' . $this->vars['news']['path'] .'.php');
									$this->view= 'AdminViews/editStory';
								}
								break;
							case "save":
								error_log(print_r($_POST,true));
								logThis($_FILES);
								if(isset($_POST['id'])){
									$news = new News();
									$news->initById($_POST['id']);
									//$news->saveHtml($_POST['html']);
								}else{
									$news = new News();
									$news->setTitle($_POST['title']);
									$news->setImage($_POST['image']);
									//$news->saveHtml($_POST['html']);
									//$news->save();
								}
								
								break;
							default:
								break;
						}
						
					break;

					case "id":
						break;

					case "users":
						break;

					case "resources":
						break;

					case "output":
						$this->view = 'json';

					default;
						break;
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

?>

