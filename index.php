<?php

require_once './vendor/autoload.php';

use App\Routing\Router;
use App\Services\Logger;

$logger = new Logger();
$logger->log();

$router = new Router();
$router->add('GET', '/', 'CurrencyController@index');
$router->add('GET', '/base/{currency}', 'CurrencyController@base');
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);