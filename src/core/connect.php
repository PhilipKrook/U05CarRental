<?php

require_once 'dbconfig.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    echo "Connected to $dbname at $host successfully WOOHOO!";
    } catch (PDOException $pe) {
        die("Could not connect to the database $dbname BUUHUU :" . $pe->getMessage());
    }
