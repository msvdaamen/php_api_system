<?php

use App\Router\Route;

require 'vendor/autoload.php';
include 'routes/router.php';

$router = new Route();
$router->init();