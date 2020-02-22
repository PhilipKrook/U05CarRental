<?php

namespace RentalCar\Models;

use RentalCar\Exceptions\DbException;
use RentalCar\Exceptions\NotFoundException;
use PDO;

class CheckInModel extends AbstractModel {
    public function checkInList() {

    $cars = [];
    /* *** Cars *** */
    $carRows = $this->db->query("SELECT * FROM Cars");
    if (!$carRows) die($this->db->errorInfo());

    foreach ($carRows as $carRow) {
      $carID = htmlspecialchars($carRow["carID"]);
      $carMake = htmlspecialchars($carRow["carMake"]);
      $carColour = htmlspecialchars($carRow["carColour"]);
      $car = ["carID" => $carID,
              "Make" => $carMake,              
              "Colour" => $carColour];      
      $customers['cars'][] = $car;      
    }
    return $cars;    
    }
}