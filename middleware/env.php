<?php
require_once("vendor/autoload.php");
//Autoloading fails sometimes.
include 'classes/Auth.php';
include 'classes/DB.php';
// Esto se puede cambiar si se llega a mover al archivo .env a un directorio mas seguro
$dotenv = Dotenv\Dotenv::createImmutable("."); 
$dotenv->load();



ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(-1);

function exception_handler(Throwable $exception) {
    $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
    header($protocol . ' 200 OK' );
    //echo "Uncaught exception: " , $exception->getMessage(), "\n";
}

set_exception_handler('exception_handler');
