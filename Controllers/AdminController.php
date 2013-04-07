<?php
require_once "AbstractController.php";
require_once "Models/News.php";
require_once "Models/NewsBundle.php";
require_once "Models/Hours.php";
require_once "Models/Contact.php";

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
	 	//Verify admin privilege
	 	/*
	 	if($_SESSION['user']->getUserAuth()!=3){
	 		//Not privileged
	 		header('/');
	 	}
	 	*/
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
			if(count($children)==0){
				//If it's just a request to the admin page then get the landing
				$children = array('default' => 'display');
			}
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
										$this->vars['imagePath'] = $imageName;
									}
								}
								$this->view = 'json';
								break;

							//AJAX endpoint for image upload on edit article page
							case "updateImg":
								if(isset($_POST['story-id']) && isset($_FILES['story-image'])){
									$news = new News();
									$news->initById($_POST['story-id']);
									if($_FILES['story-image']['error']===0){
										$picName = $_FILES['story-image']['name'];
										$ext = end(explode('.', $picName));
										if($ext === 'jpeg' || $ext === 'jpg' ||$ext === 'png' || $ext === 'gif'){
											$imageName = $news->getPath().'.'.$ext;
											move_uploaded_file($_FILES["story-image"]["tmp_name"],'Views/Stories/Images/'.$imageName);
										}else{
											$imageName = '';
										}
										if($imageName != ''){
											$news->setImage($imageName);
											$news->save();
											$this->vars['imagePath']=$news->getImage();
										}
									}
								}
								$this->view='json';
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
								$path = null;
								$return = false;
								if(isset($_POST['id'])){
									//if removed from edit page
									$news= new News();
									$news->initById($_POST['id']);
									$path = $this->NEWS_IMAGE_PATH.$news->getImage();
									$news->setImage('');
									$news->save();
								}else if(isset($_POST['imagePath'])){
									//if removed from new page
									$name=end(explode('/', $_POST['imagePath']));
									$path=$this->NEWS_IMAGE_PATH.$name;
								}
								if($path!==null){
									$exists = file_exists($path);
									if($exists){
										unlink($path);
										$return = true;
									}
								}
								$this->vars['success']=$return;
								$this->view = 'json';
								break;

							default:
								break;
						}
						break;

					case 'hours':
						switch ($actions['hours']) {
							case 'id':
								//Respond to ajax change to an hour
								$oldID = explode('|',$_POST['id']);
								$newData = $_POST['new'];
								
								//Convert new data to military time
								$tmp = explode(':',$newData);
								//The last two digits should be am or pm
								$ampm = substr($tmp[1], 2);
								if(strcmp($ampm, 'pm')==0){
									$tmp[0] = intval($tmp[0]) + 12;
								}else{
									//If am and 12 then that's really 0
					
									if(intval($tmp[0])==12 || intval($tmp[0])==24){
										$tmp[0] = '00';
									}else{
										if($tmp[0] < 10){
											$tmp[0] = '0' . strval($tmp[0]);
										}else{
											$tmp[0] = strval($tmp[0]);	
										}
										
									}
									
								}
								$newTime = $tmp[0] . substr($tmp[1],0,2);


								$modelObj = new Hours('AdminHours');
								$success = $modelObj->updateHours($oldID,$newTime);							
								break;
							case 'new':
								$id = $_POST['memberID'];
								if(strval($id)==-1){
									$this->vars['errors']['id'] = 'You must select a Crew Member';
								}
								$hour=$_POST['bigHand'] . $_POST['littleHand'];
								if(strlen($hour)==4){

								}else{
									$this->vars['errors']['time'] = 'Invalid Time -Please use military';
								}
								$day = $_POST['day'];
								$modelObj = new Hours('AdminHours');
								if(!isset($this->vars['errors'])){
									$modelObj->addHours($id,$hour,$day);	
								}
								$this->vars['hours'] = $modelObj->getAllHours();
								$this->vars['members'] = $modelObj->getActiveMembers();
								$this->view = 'AdminHours';
								break;
							case 'delete':
								//Json only.
								$info = explode('|',$_POST['id']);
								$modelObj = new Hours('json');
								if($modelObj->deleteHours($info)){
									$this->vars['success'] = true;
								}else{
									$this->vars['success'] = false;
								}
								$this->view = 'json';
								break;
							default:
								//Display the very ajax riffic table
								$modelObj = new Hours('AdminHours');
								$this->vars['hours'] = $modelObj->getAllHours();
								$this->vars['members'] = $modelObj->getActiveMembers();
								$this->view = 'AdminHours';
								break;
						}
						break;
					case "contact":
						switch ($actions['contact']) {
							case 'add':
								//Adding a new email via ajax post
								$this->view = 'json';
								$email = $_POST['email'];
								$modelObj = new Contact($this->view);
								$this->vars['success'] = $modelObj->addEmail($email);
								break;
							case 'delete':
								//Remove an email via ajax
								$this->view = 'json';
								$id = $_POST['id'];
								$modelObj = new Contact($this->view);
								$this->vars['success'] = $modelObj->deleteEmail($id);
								break;
							case 'edit':
								//Update an email via ajax
								$this->view = 'json';
								$id = $_POST['id'];
								$new = $_POST['newEmail'];
								$modelObj = new Contact($this->view);
								$this->vars['success'] = $modelObj->updateEmail($id,$new);
								break;
							default:
								//Default view of the admin for contact administration
								$this->view = 'AdminViews/contact';
								$modelObj = new Contact($this->view);
								$this->vars['emails'] = $modelObj->getContacts();
								break;
						}
						break;						

					case "users":
						break;

					case "resources":
						break;

					case "output":
						$this->view = 'json';
						break;

					case "id":
						break;
					default:
						$this->view = 'AdminViews/landing';
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

