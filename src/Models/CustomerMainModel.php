<?php

namespace RentalCar\Models;

use RentalCar\Exceptions\DbException;
use RentalCar\Exceptions\NotFoundException;
use PDO;

class CustomerMainModel extends AbstractModel {
  public function customerList() {
    $customerRows = $this->db->query("SELECT * FROM Customers");
    if (!$customerRows) die($this->db->errorInfo());
      
    $customers = [];
    foreach ($customerRows as $customerRow) {
      $customerID = htmlspecialchars($customerRow["customerID"]);
      $customerName = htmlspecialchars($customerRow["customerName"]);
      $customerAddress = htmlspecialchars($customerRow["customerAddress"]);
      $customerPostal = htmlspecialchars($customerRow["customerPostal"]);
      $customerPhone = htmlspecialchars($customerRow["customerPhone"]);
      $customer = ["customerID" => $customerID,
                   "customerName" => $customerName,                   
                   "customerAddress" => $customerAddress,
                   "customerPostal" => $customerPostal,
                   "customerPhone" => $customerPhone];      
      $customers[] = $customer;      
    }    
    return $customers;
  } 
}