<?php session_start();

define('PATHROOT',__DIR__);
define('DS',DIRECTORY_SEPARATOR);
define('PATHVIEW',PATHROOT.DS.'vues'.DS);
define('PATHCTRL',PATHROOT.DS.'controllers'.DS);
define('PATHMDL',PATHROOT.DS.'models'.DS);

require PATHMDL.'user.php';
require PATHCTRL.'userController.php';

$content = filter_input(INPUT_GET,'page', FILTER_SANITIZE_STRING);

$action = filter_input(INPUT_GET,'action', FILTER_SANITIZE_STRING);

if(!is_null($action)){
    $tabAction = explode('-', $action);
    $controleur = $tabAction[0].'Controller';
    $method = $tabAction[1].'Action';
    $object = new $controleur();
    $object->$method();
}

if(is_null($content) /*|| !file_exists(PATHVIEW.$content.'.php')*/){
    $content = 'accueil';
}

include PATHVIEW.'page.php';