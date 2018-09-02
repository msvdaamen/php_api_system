<?php
//header("Access-Control-Allow-Origin: *");



use App\Router\Route;

require 'vendor/autoload.php';
include 'routes/router.php';

/**
 * @param null $message
 */
function dd($message = null) {
    if($message) {
        print_r($message);
    }
    die();
}


$router = new Route();
$router->init();