<?php

namespace RentalCar\Models;

//use Bank\Domain\Bank;
use RentalCar\Exceptions\DbException;
use RentalCar\Exceptions\NotFoundException;
use PDO;

class CustomerModel extends AbstractModel {
  public function customerAdd($customerName, $customerID, $customerAddress, $customerPostal, $customerPhone) {
    $customersQuery = "INSERT INTO Customers(customerName, customerID, customerAddress, customerPostal, customerPhone) " .
                      "VALUES(:customerName, :customerID, :customerAddress, :customerPostal, :customerPhone)";
    $customersStatement = $this->db->prepare($customersQuery);
    $customersStatement->execute(["customerName" => $customerName, 
                                  "customerID" => $customerID, 
                                  "customerAddress" => $customerAddress, 
                                  "customerPostal" => $customerPostal, 
                                  "customerPhone" => $customerPhone]);
    if (!$customersStatement) die("Fatal error."); // $this->db->errorInfo());
    $customerNumber = $this->db->lastInsertId();
    return $customerNumber;
  }

  public function customerEdit($customerNumber, $customerNewName, $customerNewAddress, $customerNewPostal, $customerNewPhone) {
    $customersQuery = "UPDATE Customers SET customerName = :customerName,
                                            customerAddress = :customerAddress, 
                                            customerPostal = :customerPostal, 
                                            customerPhone = :customerPhone,
                                            customerNumber = :customerNumber 
                                            WHERE customerNumber = :customerNumber";
    $customersStatement = $this->db->prepare($customersQuery);
    $customersParameters = ["customerName" => $customerNewName,
                            "customerAddress" => $customerNewAddress,
                            "customerPostal" => $customerNewPostal,
                            "customerPhone" => $customerNewPhone,
                            "customerNumber" => $customerNumber];
                            
    $customersResult = $customersStatement->execute($customersParameters);
    if (!$customersResult) die($this->db->errorInfo()[2]);
  }

  public function customerRemove($customerNumber) {
    $carsQuery = "SELECT COUNT(*) FROM Cars WHERE customerNumber = :customerNumber";
    $carsStatement = $this->db->prepare($carsQuery);
    $carsResult = $carsStatement->execute(["customerNumber" => $customerNumber]);
    if (!$carsResult) die($this->db->errorInfo()[2]);
    $carsRows = $carsStatement->fetchAll();
    $numberOfCars = htmlspecialchars($carsRows[0]["COUNT(*)"]);
    
    if ($numberOfCars == 0) {
      $customersQuery = "DELETE FROM Customers WHERE customerNumber = :customerNumber";
      $customersStatement = $this->db->prepare($customersQuery);
      $customersResult = $customersStatement->execute(["customerNumber" => $customerNumber]);
      if (!$customersResult) die($this->db->errorInfo()[2]);
    }

    return $numberOfCars;
  }  

 /* public function carAdd($customerNumber) {
    $carsQuery = "INSERT INTO Cars(customerNumber) VALUES(:customerNumber)";
    $carsStatement = $this->db->prepare($carsQuery);
    $carsStatement->execute(["customerNumber" => $customerNumber]);
    if (!$carsStatement) die($this->db->errorInfo()[2]);
    $carID = $this->db->lastInsertId();
    return $carID;
  }  */
}