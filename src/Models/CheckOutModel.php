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
      $car = ["carID" => $carID,
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
      $customerAddress = htmlspecialchars($customerRow["customerAddress"]);
      $customer = ["customerID" => $customerID,
                   "Name" => $customerName,              
                   "Address" => $customerAddress];      
      $customers['customers'][] = $customer;      
      }    
      return $customers;
    }
}