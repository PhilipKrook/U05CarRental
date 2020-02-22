<?php

namespace RentalCar\Models;

use RentalCar\Exceptions\DbException;
use RentalCar\Exceptions\NotFoundException;
use PDO;

class CheckOutModel extends AbstractModel {
    public function checkOutList() {

    $customers = [];
    
    /* *** Cars *** */
    $carRows = $this->db->query("SELECT * FROM Cars");
    if (!$carRows) die($this->db->errorInfo());

    foreach ($carRows as $carRow) {
      $carID = htmlspecialchars($carRow["carID"]);
      $carMake = htmlspecialchars($carRow["carMake"]);
      $carColour = htmlspecialchars($carRow["carColour"]);
      $car = ["Id" => $carID,
              "Make" => $carMake,              
              "Colour" => $carColour];      
      $customers['cars'][] = $car;      
    }

    /* *** Customers *** */
    $customerRows = $this->db->query("SELECT * FROM Customers");
    if (!$customerRows) die($this->db->errorInfo());
     
    foreach ($customerRows as $customerRow) {
      $customerID = htmlspecialchars($customerRow["customerID"]);
      $customerName = htmlspecialchars($customerRow["customerName"]);
      $customer = ["Id" => $customerID,
                   "Name" => $customerName];      
      $customers['customers'][] = $customer;      
      }    
      return $customers;
    }

    public function checkOut() {
      $checkOutQuery = "SELECT Cars GET carID WHERE carID = :carID";
    }    
}