<?php session_start();

define('PATHROOT',__DIR__);
define('DS',DIRECTORY_SEPARATOR);
define('PATHVIEW',PATHROOT.DS.'vues'.DS);
define('PATHCTRL',PATHROOT.DS.'controllers'.DS);
define('PATHMDL',PATHROOT.DS.'models'.DS);
$config = yaml_parse_file(PATHROOT.DS.'conf'.DS.'parameters.yml');

require PATHMDL.'user.php';
require PATHCTRL.'userController.php';
require PATHCTRL.'dbController.php';
$oBdd = new dbController($config['dbconfig']);

$page = filter_input(INPUT_GET,'page', FILTER_SANITIZE_STRING);

$action = filter_input(INPUT_GET,'action', FILTER_SANITIZE_STRING);

if(!is_null($action)){
    $tabAction = explode('-', $action);
    $controleur = $tabAction[0].'Controller';
    $method = $tabAction[1].'Action';
    $object = new $controleur();
    $resAction = $object->$method();
    
    if($resAction){
        $page = $resAction;
    }
}

if(is_null($page) || !file_exists(PATHVIEW.$page.'.php')){
    $page = 'accueil';
}

include PATHVIEW.'page.php';