<?php

class View{
    public $view;
    public $vars = array();

    function __construct($view, $vars = null){
        if(!is_null($vars)){
            $this->vars = $vars;
        }

        $this->view = $view;
        // $this->view = "Stats1";
        if(!isset($_SESSION['error']) || $_SESSION['error'] == false){
            $this->display();
        }else{
            $_SESSION['error'] = false;
            header("location: ".BASEDIR."Error/");
        }
    }



    public function display(){
        if($this->view == "json"){
            include_once 'Views' . '/' . $this->view . '.php';
        }else{
            if(file_exists('Views' . '/' . $this->view . '.php')){
                include_once 'Views/Header.php';
                include_once 'Views' . '/' . $this->view . '.php';
                include_once 'Views/footer.php';
            }
            else{
                include_once('Views/Home.php');
            }
        }
    } // end display
}

?>