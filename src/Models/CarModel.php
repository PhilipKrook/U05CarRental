<?php

namespace RentalCar\Models;

//use Bank\Domain\Bank;
use RentalCar\Exceptions\DbException;
use RentalCar\Exceptions\NotFoundException;
use PDO;

class CarModel extends AbstractModel {
  public function addcar($carMake, $carID, $carColour, $carYear, $carPrice) {
    $carsQuery = "INSERT INTO cars(carMake, carID, carColour, carYear, carPrice) " .
                      "VALUES(:carMake, :carID, :carColour, :carYear, :carPrice)";
    $carsStatement = $this->db->prepare($carsQuery);
    $carsStatement->execute(["carMake" => $carMake, 
                                  "carID" => $carID, 
                                  "carColour" => $carColour, 
                                  "carYear" => $carYear, 
                                  "carPrice" => $carPrice]);
    if (!$carsStatement) die("Fatal error."); // $this->db->errorInfo());
    $carNumber = $this->db->lastInsertId();
    return $carNumber;
  }

  public function editcar($carID, $carNewModel, $carNewColour, $carNewYear, $carNewPrice) {
    $carsQuery = "UPDATE cars SET carID = :carID,
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

  public function removecar($carID) {
    $carsQuery = "SELECT COUNT(*) FROM Cars WHERE carID = :carID";
    $carsStatement = $this->db->prepare($carsQuery);
    $carsResult = $carsStatement->execute(["carID" => $carID]);
    if (!$carsResult) die($this->db->errorInfo()[2]);
    $carsRows = $carsStatement->fetchAll();
    $numberOfCars = htmlspecialchars($carsRows[0]["COUNT(*)"]);
    
    if ($numberOfCars == 0) {
      $carsQuery = "DELETE FROM cars WHERE carID = :carID";
      $carsStatement = $this->db->prepare($carsQuery);
      $carsResult = $carsStatement->execute(["carID" => $carID]);
      if (!$carsResult) die($this->db->errorInfo()[2]);
    }

    return $numberOfCars;
  }  

  public function addCar($carID) {
    $carsQuery = "INSERT INTO Cars(carID) VALUES(:carID)";
    $carsStatement = $this->db->prepare($carsQuery);
    $carsStatement->execute(["carID" => $carID]);
    if (!$carsStatement) die($this->db->errorInfo()[2]);
    $carsID = $this->db->lastInsertId();
    return $carsID;
  }  
}