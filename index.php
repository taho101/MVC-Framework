<?php

//enable error reporting
error_reporting(E_ALL);

//define project root
$site_path = realpath(dirname(__FILE__));
define ('DOCUMENT_ROOT', $site_path);

//include setup file
include_once('app/includes/init.php');

//initialize the registry
$registry = new registry();

//initialize the database
$registry->db = dbHandler::getInstance();

//initialize the rowter
$registry->router = new router($registry);

//setup controller
$registry->router->setPath(DOCUMENT_ROOT . '/app/controller');

//setup the template
$registry->template = new template($registry);

//load the controller
$registry->router->loader();

?>