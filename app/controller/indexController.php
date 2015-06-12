<?php

class indexController extends baseController{
    
    public function index(){
        $this->registry->template->id = 'Welcome to The MVC WORLD';
        
        $this->registry->template->show('index');
    }
    
    public function category($id = 1, $data = 1){
        $this->registry->template->welcome_id = $id;
        $this->registry->template->welcome = $data;
        
        $this->registry->template->show('category');
    }
}
?>