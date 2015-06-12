<?php

class template{
    
    private $registry;
    
    private $vars = [];
    
    function __construct($registry) {
        $this->registry = $registry;
    }
    
    public function __set($index, $value){
        $this->vars[$index] = $value;
    }
    
    public function show($name) {
        $folder = $this->registry->router->controller;
        $path = DOCUMENT_ROOT . '/app/views/'.$folder.'/'.$name.'.php';

        if (file_exists($path) == false){
                //try template outside of the file structure
                $path = DOCUMENT_ROOT . '/app/views/'.$name.'.php';
                
                if(file_exists($path) == false){
                    throw new Exception('Template not found in '.$path);
                
                    return false;
                }
        }

        // Load variables
        foreach ($this->vars as $key => $value){
                $$key = $value;
        }

        include_once($path);
    }
}

?>