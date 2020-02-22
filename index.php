<?php
use RentalCar\Core\Config;
use RentalCar\Core\Router;
use RentalCar\Core\Request;
use RentalCar\Utils\DependencyInjector;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Core/Config.php';
require_once __DIR__ . '/src/Utils/DependencyInjector.php';
require_once __DIR__ . '/src/Core/Router.php';
require_once __DIR__ . '/src/Core/Request.php';


$config = new Config();
$dbConfig = $config->get('database');

$db = new PDO(
    'mysql:host=' . $dbConfig['host'] .
    ';dbname=' . $dbConfig['database'],
    $dbConfig['user'],
    $dbConfig['password']
);

$loader = new Twig_Loader_Filesystem(__DIR__ . '/views');
$view = new Twig_Environment($loader);

$log = new Logger('bookstore');
$logFile = $config->get('log');
$log->pushHandler(new StreamHandler($logFile, Logger::DEBUG));

$di = new DependencyInjector();
$di->set('PDO', $db);
$di->set('Utils\Config', $config);
$di->set('Twig_Environment', $view);
$di->set('Logger', $log);

echo "<!DOCTYPE html>";
$router = new Router($di);
$response = $router->route(new Request());
echo $response;