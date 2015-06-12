<?php

class blogController extends baseController{
    
    public function index(){
        $this->registry->template->blogName = "Welcome to the blog";
        
        $this->registry->template->show('index');
    }
}

?>