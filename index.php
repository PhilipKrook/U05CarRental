<?php
require_once 'connect.php';

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