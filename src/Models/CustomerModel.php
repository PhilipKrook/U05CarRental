<?php

namespace RentalCar\Models;

use RentalCar\Exceptions\DbException;
use RentalCar\Exceptions\NotFoundException;
use PDO;

class CustomerModel extends AbstractModel {
  function __construct($db){
    parent::__construct($db);
  }
  public function customerAdd($customerID, $customerName, $customerAddress, $customerPostal, $customerPhone) {
    $customersQuery = "INSERT INTO Customers(customerID, customerName, customerAddress, customerPostal, customerPhone) " .
                      "VALUES(:customerID, :customerName, :customerAddress, :customerPostal, :customerPhone)";
    $customersStatement = $this->db->prepare($customersQuery);
    $customersStatement->execute(["customerID" => $customerID,
                                  "customerName" => $customerName,                                    
                                  "customerAddress" => $customerAddress, 
                                  "customerPostal" => $customerPostal, 
                                  "customerPhone" => $customerPhone]);
    if (!$customersStatement) die("Fatal error.");
  }

  public function customerEdit($customerID, $customerNewName, $customerNewAddress, $customerNewPostal, $customerNewPhone) {
    $customersQuery = "UPDATE Customers SET customerID = :customerID,
                                            customerName = :customerName,
                                            customerAddress = :customerAddress, 
                                            customerPostal = :customerPostal, 
                                            customerPhone = :customerPhone,
                                            WHERE customerID = :customerID";
    $customersStatement = $this->db->prepare($customersQuery);
    $customersParameters = ["customerID" => $customerID,
                            "customerName" => $customerNewName,
                            "customerAddress" => $customerNewAddress,
                            "customerPostal" => $customerNewPostal,
                            "customerPhone" => $customerNewPhone];
                            
    $customersResult = $customersStatement->execute($customersParameters);
    if (!$customersResult) die($this->db->errorInfo()[2]);
  }

  public function customerRemove($customerID) {
    $customersQuery = "DELETE FROM Customers WHERE customerID = :customerID";
    $customersStatement = $this->db->prepare($customersQuery);
    $customersResult = $customersStatement->execute(["customerID" => $customerID]);
    if (!$customersResult) die($this->db->errorInfo()[2]);
  }  
}