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
      $carMake = htmlspecialchars($carRow["carMake"]);
      $carID = htmlspecialchars($carRow["carID"]);
      $carColour = htmlspecialchars($carRow["carColour"]);
      $carYear = htmlspecialchars($carRow["carYear"]);
      $carPrice = htmlspecialchars($carRow["carPrice"]);
      $car = ["carMake" => $carMake,
                   "carID" => $carID,
                   "carColour" => $carColour,
                   "carYear" => $carYear,
                   "carPrice" => $carPrice];      
       $cars[] = $car;      
    }    
    return $cars;
  } 
}