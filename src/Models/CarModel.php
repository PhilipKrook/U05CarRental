<?php

namespace RentalCar\Models;

use RentalCar\Exceptions\DbException;
use RentalCar\Exceptions\NotFoundException;
use PDO;

class CarModel extends AbstractModel {
  function __construct($db){
    parent::__construct($db);
  }
  public function carAdd($carID, $carMake, $carColour, $carYear, $carPrice) {
    $carsQuery = "INSERT INTO Cars(carID, carMake, carColour, carYear, carPrice) " .
                      "VALUES(:carID, :carMake, :carColour, :carYear, :carPrice)";
    $carsStatement = $this->db->prepare($carsQuery);
    $carsStatement->execute(["carID" => $carID, 
                             "carMake" => $carMake,                              
                             "carColour" => $carColour, 
                             "carYear" => $carYear, 
                             "carPrice" => $carPrice]);
    if (!$carsStatement) die("Fatal error."); 
  }

  public function carEdit($carID, $carNewMake, $carNewColour, $carNewYear, $carNewPrice) {
    $carsQuery = "UPDATE Cars SET carID = :carID,
                                  carMake = :carMake, 
                                  carColour = :carColour, 
                                  carYear = :carYear,
                                  carPrice = :carPrice
                                  WHERE carID = :carID";
    $carsStatement = $this->db->prepare($carsQuery);
    $carsParameters = ["carID" => $carID,
                       "carMake" => $carNewMake,
                       "carColour" => $carNewColour,
                       "carYear" => $carNewYear,
                       "carPrice" => $carNewPrice];                            
    $carsResult = $carsStatement->execute($carsParameters);
    
    if (!$carsResult) die($this->db->errorInfo()[2]);
  }

  public function carRemove($carID) {
    $carsQuery = "DELETE FROM Cars WHERE carID = :carID";
    $carsStatement = $this->db->prepare($carsQuery);
    $carsResult = $carsStatement->execute(["carID" => $carID]);
    if (!$carsResult) die($this->db->errorInfo()[2]);
  }    
}