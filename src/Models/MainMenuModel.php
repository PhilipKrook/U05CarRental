<?php

namespace RentalCar\Models;

use RentalCar\Exceptions\DbException;
use RentalCar\Exceptions\NotFoundException;
use PDO;

class MainMenuModel extends AbstractModel {
  public function customerList() {
    $customerRows = $this->db->query("SELECT * FROM Customers");
    if (!$customerRows) die($this->db->errorInfo());
      
    $customers = [];
    foreach ($customerRows as $customerRow) {
      $customerNumber = htmlspecialchars($customerRow["customerNumber"]);
      $customerName = htmlspecialchars($customerRow["customerName"]);
      $customerID = htmlspecialchars($customerRow["customerID"]);
      $customerAddress = htmlspecialchars($customerRow["customerAddress"]);
      $customerPostal = htmlspecialchars($customerRow["customerPostal"]);
      $customerPhone = htmlspecialchars($customerRow["customerPhone"]);
      $customer = ["customerNumber" => $customerNumber,
                   "customerName" => $customerName,
                   "customerID" => $customerID,
                   "customerAddress" => $customerAddress,
                   "customerPostal" => $customerPostal,
                   "customerPhone" => $customerPhone];        
        
      $carsQuery = "SELECT * FROM Cars WHERE customerNumber = :customerNumber";
      $carsStatement = $this->db->prepare($carsQuery);
      $carsResult = $carsStatement->execute(["customerNumber" => $customerNumber]);
      if (!$carsResult) die($this->db->errorInfo());
      $carsRows = $carsStatement->fetchAll();

      /* $cars = [];
      foreach ($carsRows as $carRow) {
        $carID = htmlspecialchars($carRow["carID"]);
        $car = ["carID" => $carID];
        
        $balanceQuery = "SELECT SUM(amount) FROM Events WHERE accountNumber = :accountNumber";
        $balanceStatement = $this->db->prepare($balanceQuery);
        $balanceResult = $balanceStatement->execute(["accountNumber" => $accountNumber]);
        if (!$balanceResult) die($this->db->errorInfo());

        $balanceRows = $balanceStatement->fetchAll();
        $accountBalance = htmlspecialchars($balanceRows[0]["SUM(amount)"]);
        
        if ($accountBalance === "") {
          $accountBalance = "0";
        }

        $account["accountBalance"] = $accountBalance;
        $accounts[] = $account;
      }*/

      $customer["accounts"] = $accounts;
      $customers[] = $customer;
    }
      
    return $customers;
  }
}