<?php

namespace RentalCar\Models;

//use Bank\Domain\Bank;
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
        
      $accountsQuery = "SELECT * FROM Accounts WHERE customerNumber = :customerNumber";
      $accountsStatement = $this->db->prepare($accountsQuery);
      $accountsResult = $accountsStatement->execute(["customerNumber" => $customerNumber]);
      if (!$accountsResult) die($this->db->errorInfo());
      $accountsRows = $accountsStatement->fetchAll();

      $accounts = [];
      foreach ($accountsRows as $accountRow) {
        $accountNumber = htmlspecialchars($accountRow["accountNumber"]);
        $account = ["accountNumber" => $accountNumber];
        
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
      }

      $customer["accounts"] = $accounts;
      $customers[] = $customer;
    }
      
    return $customers;
  }
}