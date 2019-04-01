<?php session_start();

define('PATHROOT',__DIR__);
define('DS',DIRECTORY_SEPARATOR);
define('PATHVIEW',PATHROOT.DS.'vues'.DS);
define('PATHCTRL',PATHROOT.DS.'controllers'.DS);
define('PATHMDL',PATHROOT.DS.'models'.DS);

function autoLoadModel($modelName){
    if(file_exists(PATHMDL.$modelName.'.php')){
        require_once PATHMDL.$modelName.'.php';
    }
}

function autoLoadController($controllerName){
    if(file_exists(PATHCTRL.$controllerName.'.php')){
        require_once PATHCTRL.$controllerName.'.php';
    }
}

spl_autoload_register('autoLoadModel');
spl_autoload_register('autoLoadController');

$page = filter_input(INPUT_GET,'page', FILTER_SANITIZE_STRING);
$action = filter_input(INPUT_GET,'action', FILTER_SANITIZE_STRING);

if(!is_null($action)){
    $tabAction = explode('-', $action);
    $controleur = $tabAction[0].'Controller';
    $method = $tabAction[1].'Action';
    $object = new $controleur();
    $resAction = $object->$method();
    
    if(is_array($resAction) && isset($resAction['view'])){
        $page = $resAction['view'];
    }
}

if(is_null($page) || !file_exists(PATHVIEW.$page.'.php')){
    $page = 'accueil';
}

include PATHVIEW.'page.php';