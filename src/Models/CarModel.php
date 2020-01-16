<?php

namespace RentalCar\Models;

use RentalCar\Exceptions\DbException;
use RentalCar\Exceptions\NotFoundException;
use PDO;

class CarModel extends AbstractModel {
  function __construct($db){
    parent::__construct($db);
  }
  public function carAdd($carMake, $carID, $carColour, $carYear, $carPrice) {
    $carsQuery = "INSERT INTO Cars(carMake, carID, carColour, carYear, carPrice) " .
                      "VALUES(:carMake, :carID, :carColour, :carYear, :carPrice)";
    $carsStatement = $this->db->prepare($carsQuery);
    $carsStatement->execute(["carMake" => $carMake, 
                              "carID" => $carID, 
                              "carColour" => $carColour, 
                              "carYear" => $carYear, 
                              "carPrice" => $carPrice]);
    if (!$carsStatement) die("Fatal error."); 
    $carNumber = $this->db->lastInsertId();
    return $carNumber;
  }

  public function carEdit($carID, $carNewModel, $carNewColour, $carNewYear, $carNewPrice) {
    $carsQuery = "UPDATE Cars SET carID = :carID,
                                  carColour = :carColour, 
                                  carYear = :carYear, 
                                  carPrice = :carPrice,
                                  carMake = :carMake 
                                  WHERE carID = :carID";
    $carsStatement = $this->db->prepare($carsQuery);
    $carsParameters = ["carMake" => $carNewMake,
                       "carColour" => $carNewColour,
                       "carYear" => $carNewYear,
                       "carPrice" => $carNewPrice,
                       "carID" => $carID];
                            
    $carsResult = $carsStatement->execute($carsParameters);
    if (!$carsResult) die($this->db->errorInfo()[2]);
  }

  public function carRemove($carID) {
    $carsQuery = "DELETE FROM Cars WHERE carID = :carID";
    $carsStatement = $this->db->prepare($carsQuery);
    $carsResult = $carsStatement->execute(["carID" => $carID]);
    if (!$carsResult) die($this->db->errorInfo()[2]);
  }  

  /* public function carAdd($carID) {
    $carsQuery = "INSERT INTO Cars(carID) VALUES(:carID)";
    $carsStatement = $this->db->prepare($carsQuery);
    $carsStatement->execute(["carID" => $carID]);
    if (!$carsStatement) die($this->db->errorInfo()[2]);
    $carsID = $this->db->lastInsertId();
    return $carsID;
  }  */
}