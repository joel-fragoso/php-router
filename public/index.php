<?php declare(strict_types=1);

error_reporting(1);
ini_set('display_errors', '1');

date_default_timezone_set('America/Sao_Paulo');

require __DIR__ . '/../vendor/autoload.php';

use Exception;
use Prix\Router;

$router = new Router();

$router->addRoute('/', function () {
	echo 'Hello World!';
});

$router->addRoute('/users', function () {
	echo 'Users';
});

$uri = $_SERVER['REQUEST_URI'];

try {
    $router->dispatch($uri);
} catch (Exception $e) {
    echo $e->getMessage();
}

var_dump($router);
