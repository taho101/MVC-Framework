<?php

//include base controller
include_once(DOCUMENT_ROOT . '/app/core/controller_base.class.php');

//include registry
include_once(DOCUMENT_ROOT . '/app/core/registry.class.php');

//include router
include_once(DOCUMENT_ROOT . '/app/core/router.class.php');

//include base template
include_once(DOCUMENT_ROOT . '/app/core/template.class.php');

//register autoload
function __autoload($class_name) {
    $filename = strtolower($class_name) . '.class.php';
    $file = DOCUMENT_ROOT . '/app/model/' . $filename;

    if (file_exists($file) == false){
        $file = DOCUMENT_ROOT . '/app/includes/helpers/' . $filename;
        
        if (file_exists($file) == false){
            return false;
        }
    }
    
    include_once($file);
}

//include constants
include_once(DOCUMENT_ROOT . '/app/includes/config.php');

?>