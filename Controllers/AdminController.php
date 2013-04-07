<?php
require_once "AbstractController.php";
require_once "Models/News.php";
require_once "Models/NewsBundle.php";

class AdminController extends AbstractController{
	private $POST;
	private $actions;
	private $view;
	public $vars;

	private $NEWS_CONTENT_PATH = "Views/Stories/Content/";
	private $NEWS_IMAGE_PATH = "Views/Stories/Images/"; 

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

							//Form Submit for a new article
							case "saveNew":
								logThis($_POST);
								$news = new News();
								$news->setTitle($_POST['news-title']);
								$news->saveHtml($_POST['news-html']);
								if($_POST['news-image']!==''){
									$ext = end(explode('.', $_POST['news-image']));
									$oldName = end(explode('/', $_POST['news-image']));
									$newName = $news->getPath()."_image.".$ext;
									rename("Views/Stories/Images/".$oldName, "Views/Stories/Images/".$newName);
									$news->setImage($newName);
								}else{
									$news->setImage($imageName);								
								}
								$id = $news->save();
								logThis($news->toArray());
								header("location: ". BASEDIR."Admin/?news=edit&id=".$id);
								break;

							//Load new Image but don't save
							case "uploadImg":
								logThis('inUploadImg');
								$this->vars['imagePath'] = '';
								if(isset($_FILES['story-image'])){
									$picName = $_FILES['story-image']['name'];
									$ext = end(explode('.', $picName));
									if($ext === 'jpeg' || $ext === 'jpg' ||$ext === 'png' || $ext === 'gif'){
										$imageName = end(explode('/', $_FILES['story-image']['tmp_name']))."_tmp.".$ext;
										move_uploaded_file($_FILES["story-image"]["tmp_name"],'Views/Stories/Images/'.$imageName);
										$this->vars['imagePath'] = 'Views/Stories/Images/'.$imageName;
									}
								}
								$this->view = 'json';
								break;

							//AJAX endpoint for image upload
							case "updateImg":
								if(isset($_POST['story-id']) && isset($_FILES['story-image'])){
									if($_FILES['story-image']['error']===0){
										$picName = $_FILES['story-image']['name'];
										$ext = end(explode('.', $picName));
										if($ext === 'jpeg' || $ext === 'jpg' ||$ext === 'png' || $ext === 'gif'){
											$imageName = end(explode('/', $_FILES['story-image']['tmp_name'])).".".$ext;
											move_uploaded_file($_FILES["story-image"]["tmp_name"],'Views/Stories/Images/'.$imageName);
										}else{
											$imageName = '';
										}
										if($imageName != ''){
											$news = new News();
											$news->initById($_POST['story-id']);
											$news->setImage($imageName);
											$news->save();
											$this->vars['imagePath']=$news->getImage();
											$this->view='json';
										}
									}
								}
								break;

							//AJAX endpoint for saving text
							case "updateTxt":
								if(isset($_POST['id'])){
									$news = new News();
									$news->initById($_POST['id']);
									$news->saveHtml($_POST['html']);
									$this->vars['sucess']=true;
								}else{
									$this->vars['sucess']=false;
								}
								$this->view='json';
								break;

							//AJAX endpoint for removing saved picture
							case "removePicture":
								$return = false;
								if(isset($_POST['id'])){
									$news= new News();
									$news->initById($_POST['id']);
									$exists = file_exists($this->NEWS_IMAGE_PATH.$news->getImage());
									if($exists){
										unlink($this->NEWS_IMAGE_PATH.$news->getImage());
										$news->setImage('');
										$news->save();
										$return = true;
									}
								}
								$this->vars['sucess']=$return;
								$this->view = 'json';
								break;

							default:
								break;

						}
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

