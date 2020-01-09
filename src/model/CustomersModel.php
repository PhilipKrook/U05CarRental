<?php

  namespace main\model;

  use main\exceptions\NotFoundException;
  use PDO;

  class CustomersModel {
    public function addCustomer($customerID) {
        $customersQuery = "INSERT INTO Customers(customerName) " . 
                         "VALUES(:CustomerName)";
        $customersStatement = $this->db->prepare($customersQuery);
        $customersStatement->execute(["customerName" => $customerName]);
        if (!$customersStatement) die("Fatal Error.");
        $customerID = $this->db->lastInsertID();
        return $customerID;
    }

    public function editCustomer($customerID, $customerNewName) {
        $customersQuery = "UPDATE Customers SET customerName = :CustomerName " .
                          "WHERE customerID = :customerID";
        $customersStatement = $this->db->prepare($customersQuery);
        $customersParameters = ["customerName" => $customerNewName,
                                "customerID" => $customerID];
        $customersResult = $customersStatement->execute($customersParameters);
        if (!$customersResult) die($this->db->errorInfo()[2]);
    }


    # Nedan funktion måste anpassas - Den ska kolla om customer hyr en bil under vis period 
    public function removeCustomer($customerID) {
        $accountsQuery ="SELECT COUNT(*) FROM Accounts WHERE customerID = :customerID";
        $accountsStatement = $this->db->prepare($accountsQuery);
        $accountsResult = $accountsStatement->execute(["customerID" => $customerID]);
        if (!$accountResult) die($this->db->errorInfo()[2]);
        $accountRows = $accountsStatement->fetchAll();
        $numberOfAccounts = htmlspecialchars($accountRows[0]["COUNT(*)"]);

        if ($numberOfAccounts == 0) {
            $customersQuery = "DELETE FROM Customers WHERE customerID = :customerID";
            $customersStatement = $this->db->prepare($customersQuery);
            $customersResult = $customersStatement->execute(["customerID" => $customerID]);
            if (!$customersResult) die($this->db->errorInfo()[2]);
        }
        return $numberOfAccounts;
    }








  }





  /*
      private $customersArray;

      public function __construct() {
          $adam = ["name" => "Adam","address" => "Stora gatan 1", "phone" => "0123456789"];
          $sune = ["name" => "Sune","address" => "Lilla gatan 22", "phone" => "9876543210"];
          $lennart = ["name" => "Lennart","address" => "Stora torget 3", "phone" => "1029384756"];
          $greta = ["name" => "Greta","address" => "Lilla gatan 1", "phone" => "0192837465"];
          $daniel = ["name" => "Daniel","address" => "Gammla gatan 1", "phone" => "6574839201"];
          $this->customersArray = [$adam, $sune, $lennart, $greta, $daniel];
      }

      public function getAll() {
          return $this->customersArray;
      }

      public function getIndex($index) {
          if ($index < count($this->customersArray)) {
              return $this->customersArray[$index];
          }
          else {
              return null;
          }
      }
*/  