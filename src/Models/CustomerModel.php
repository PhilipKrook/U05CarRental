<?php

namespace Bank\Models;

//use Bank\Domain\Bank;
use Bank\Exceptions\DbException;
use Bank\Exceptions\NotFoundException;
use PDO;

class CustomerModel extends AbstractModel {
  public function addCustomer($customerName) {
    $customersQuery = "INSERT INTO Customers(customerName) " .
                      "VALUES(:customerName)";
    $customersStatement = $this->db->prepare($customersQuery);
    $customersStatement->execute(["customerName" => $customerName]);
    if (!$customersStatement) die("Fatal error."); // $this->db->errorInfo());
    $customerNumber = $this->db->lastInsertId();
    return $customerNumber;
  }

  public function editCustomer($customerNumber, $customerNewName) {
    $customersQuery = "UPDATE Customers SET customerName = :customerName " .
                      "WHERE customerNumber = :customerNumber";
    $customersStatement = $this->db->prepare($customersQuery);
    $customersParameters = ["customerName" => $customerNewName,
                            "customerNumber" => $customerNumber];
    $customersResult = $customersStatement->execute($customersParameters);
    if (!$customersResult) die($this->db->errorInfo()[2]);
  }

  public function removeCustomer($customerNumber) {
    $accountsQuery = "SELECT COUNT(*) FROM Accounts WHERE customerNumber = :customerNumber";
    $accountsStatement = $this->db->prepare($accountsQuery);
    $accountsResult = $accountsStatement->execute(["customerNumber" => $customerNumber]);
    if (!$accountsResult) die($this->db->errorInfo()[2]);
    $accountsRows = $accountsStatement->fetchAll();
    $numberOfAccounts = htmlspecialchars($accountsRows[0]["COUNT(*)"]);
    
    if ($numberOfAccounts == 0) {
      $customersQuery = "DELETE FROM Customers WHERE customerNumber = :customerNumber";
      $customersStatement = $this->db->prepare($customersQuery);
      $customersResult = $customersStatement->execute(["customerNumber" => $customerNumber]);
      if (!$customersResult) die($this->db->errorInfo()[2]);
    }

    return $numberOfAccounts;
  }  

  public function addAccount($customerNumber) {
    $accountsQuery = "INSERT INTO Accounts(customerNumber) VALUES(:customerNumber)";
    $accountsStatement = $this->db->prepare($accountsQuery);
    $accountsStatement->execute(["customerNumber" => $customerNumber]);
    if (!$accountsStatement) die($this->db->errorInfo()[2]);
    $accountNumber = $this->db->lastInsertId();
    return $accountNumber;
  }  
}