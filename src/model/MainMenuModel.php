<?php

namespace main\models;

# use main\exceptions\DbException;
use main\exceptions\NotFoundException;
use PDO;

class MainMenuModel extends AbstractModel {
  public function customerList() {
    $customerRows = $this->db->query("SELECT * FROM Customers");
    if (!$customerRows) die($this->db->errorInfo());
      
    $customers = [];
    foreach ($customerRows as $customerRow) {
      $customerID = htmlspecialchars($customerRow["customerID"]);
      $customerName = htmlspecialchars($customerRow["customerName"]);
      $customer = ["customerID" => $customerID,
                   "customerName" => $customerName];        
        
      $accountsQuery = "SELECT * FROM Accounts WHERE customerID = :customerID";
      $accountsStatement = $this->db->prepare($accountsQuery);
      $accountsResult = $accountsStatement->execute(["customerID" => $customerID]);
      if (!$accountsResult) die($this->db->errorInfo());
      $accountsRows = $accountsStatement->fetchAll();

      $accounts = [];
      foreach ($accountsRows as $accountRow) {
        $accountID = htmlspecialchars($accountRow["accountID"]);
        $account = ["accountID" => $accountID];
        
        /* *** Behövs detta?! ***
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

        */
      }
      

      $customer["accounts"] = $accounts;
      $customers[] = $customer;
    }
      
    return $customers;
  }
}