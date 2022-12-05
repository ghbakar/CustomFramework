<?php

require_once __DIR__ . './../vendor/autoload.php';

use App\Controllers\SiteController;
use App\core\Application;
use App\Controllers\AuthController;


// echo '<pre>';
// print_r(dirname(__DIR__));  // D:\PHP\OurFramework
// echo '</pre>';

// create initialization  from Application Class
$app = new Application(dirname(__DIR__));


/**
 * add all routing inside array routers
 */


$app->router->get('/', [new SiteController, 'Home']);

$app->router->get('/contact',  [new SiteController, 'contact']);
$app->router->post('/contact', [new SiteController, 'CantactHandling']);

$app->router->get('/login',  [new AuthController, 'login']);
$app->router->post('/login', [new AuthController, 'login']);

$app->router->get('/register',  [new AuthController, 'register']);
$app->router->post('/register', [new AuthController, 'register']);


$app->run();
