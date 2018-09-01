<?php
//header("Access-Control-Allow-Origin: *");



use App\Router\Route;

require 'vendor/autoload.php';
include 'routes/router.php';

$router = new Route();
$router->init();