<?php session_start();

define('PATHROOT',__DIR__);
define('DS',DIRECTORY_SEPARATOR);
define('PATHVIEW',PATHROOT.DS.'vues'.DS);

$content = 'hello';

include PATHVIEW.'page.php';