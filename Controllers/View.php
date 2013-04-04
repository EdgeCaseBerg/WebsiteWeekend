<?php

class View{
	public $view;
    public $vars = array();

	function __construct($view, $vars = null){
        if(!is_null($vars)){
            $this->vars = $vars;
        }

        $this->view = $view;
        $this->display();
	}



	public function display(){
        if(file_exists('Views' . '/' . $this->view . '.php')){
            include_once 'Views' . '/' . $this->view . '.php';
        }
        else{
            include_once('Views/Home.php');
        }
	} // end display
}

?>