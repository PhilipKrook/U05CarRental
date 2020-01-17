<?php

namespace RentalCar\Models;

use RentalCar\Exceptions\DbException;
use RentalCar\Exceptions\NotFoundException;
use PDO;

class CarMainModel extends AbstractModel {
  public function carList() {
    $carRows = $this->db->query("SELECT * FROM Cars");
    if (!$carRows) die($this->db->errorInfo());
      
    $cars = [];
    foreach ($carRows as $carRow) {
      $carID = htmlspecialchars($carRow["carID"]);
      $carMake = htmlspecialchars($carRow["carMake"]);
      $carColour = htmlspecialchars($carRow["carColour"]);
      $carYear = htmlspecialchars($carRow["carYear"]);
      $carPrice = htmlspecialchars($carRow["carPrice"]);
      $car = ["carID" => $carID,
              "carMake" => $carMake,              
              "carColour" => $carColour,
              "carYear" => $carYear,
              "carPrice" => $carPrice];      
       $cars[] = $car;      
    }    
    return $cars;
  } 
}