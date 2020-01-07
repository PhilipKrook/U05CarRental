<?php

use Main\Router;   
use Main\Request;

// Vi behöver lägga till dessa tre rader för att kunna använda oss av Twig. 
require_once __DIR__ . "/vendor/autoload.php"; 
$loader = new Twig_Loader_Filesystem(__DIR__); 
$twig = new Twig_Environment($loader); 

// Vi skapar objekt av klasserna Request och Router. 
$request = new Request(); 
$router = new Router(); 

// Vi anropar route i Router-objektet, som returnerar 
// den färdiga HMTL-koden, som vi skriver ut med echo. 
echo $router->route($request, $twig); 




require_once 'connect.php';
include 'Router.php';






$sql = "CREATE TABLE cars (
    car_id varchar(10) DEFAULT PRIMARY KEY,
    car_make varchar(20) DEFAULT NULL,
    car_colour varchar(20) DEFAULT NULL,
    car_year int(4) DEFAULT NULL,
    car_price int(10) DEFAULT NULL,
    car_pickup DATE DEFAULT NULL,
    car_return DATE DEFAULT NULL
    )";

$sql ="CREATE TABLE customers (
    customer_id int(12) DEFAULT PRIMARY KEY,
    customer_name varchar(20) DEFAULT NULL,
    customer_adress varchar(20) DEFAULT NULL,
    customer_city varchar(20) DEFAULT NULL,
    customer_phonenumber int(20) DEFAULT NULL #starts with 0       
    )";

