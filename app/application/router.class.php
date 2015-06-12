<?php

class router{
    
    private $registry;
    
    private $path;
    
    private $args = [];

    public $file;
   
    public $controller;
   
    public $action;
    
    public function __construct($registry){
        $this->registry = $registry;
    }
    
    public function setPath($path) {
        //check if path exists
        if (is_dir($path) == false){
                throw new Exception ('Invalid controller path: `' . $path . '`');
        }
        
        //set path
        $this->path = $path;
    }
    
    public function loader(){
        //check the route
        $this->getController();
        
        //throw 404 error if not found
        if (is_readable($this->file) == false){
                echo $this->file;
                die (' 404 Not Found');
        }
        
        include_once($this->file);
        
        //check controller instance
        $class = $this->controller . 'Controller';
        $controller = new $class($this->registry);
        
        //check available action
        if (is_callable(array($controller, $this->action)) == false){
                $action = 'index';
        }else{
                $action = $this->action;
        }
        
        //run action
        if(count($this->args) > 0){
            call_user_func_array([$controller, $action], $this->args);
        }else{
            $controller->$action();
        }
    }
    
    private function getController() {        
        //get controller route from the url
        $route = (empty($_GET['rt'])) ? '' : $_GET['rt'];
        
        if (empty($route)){
                $route = 'index';
        }else{
                //chunk the route
                $parts = explode('/', $route);
                $this->controller = $parts[0];
                if(isset( $parts[1]))
                {
                        $this->action = $parts[1];
                }
                
                //load the arguments
                for($i = 2; $i < count($parts); $i++){
                    $this->args[] = $parts[$i];
                }
        }
        
        //redirect to index if no valid path found
        if (empty($this->controller)){
                $this->controller = 'index';
        }
        
        //check the action
        if (empty($this->action)){
                $this->action = 'index';
        }
        
        //set path
        $this->file = $this->path .'/'. $this->controller . 'Controller.php';
    }
}

?>