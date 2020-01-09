<?php

namespace main\controller;

use main\exceptions\NotFoundException;
use main\models\CustomersModel;

class CustomersController {
    public function addCustomer() {
        return $this->render("AddCustomer.twig", []);    
    }

    public function customerAdded() {
        $form =$this->request->getForm();
        $customerName = $form["customerName"];
        $customerModel = new CustomerModel($this->db);
        $customerNumber = $customerModel->addCustomer($customerName);
        $properties = ["customerID" => $customerID,
                       "customerName" => $customerName];
        return $this->render("CustomerAdded.twig", $properties);
    }

    public function editCustomer($customerID, $customerName) {
        //$customerName = $map["customerName"];
        //$customerID = $map["customerID"];      
        $properties = ["customerID" => $customerID,
                       "customerName" => $customerName];
        return $this->render("EditCustomer.twig", $properties);
      }
        
      public function customerEdited($customerID, $customerOldName) {
        $form = $this->request->getForm();
        $customerNewName = $form["customerName"];
        $customerModel = new CustomerModel($this->db);
        $customerModel->editCustomer($customerID, $customerNewName);
        $properties = ["customerID" => $customerID,
                       "customerOldName" => $customerOldName,
                       "customerNewName" => $customerNewName];
        return $this->render("CustomerEdited.twig", $properties);
      }    
        
      public function removeCustomer($customerID, $customerName) {
        $customerModel = new CustomerModel($this->db);
        $numberOfAccounts = $customerModel->removeCustomer($customerID);
        $properties = ["customerID" => $customerID,
                       "customerName" => $customerName,
                       "numberOfAccounts" => $numberOfAccounts];
        return $this->render("CustomerRemoved.twig", $properties);
      }



      /*    *** Behövs denna funktion här? ***
      public function addAccount($customerID, $customerName) {
        $customerModel = new CustomerModel($this->db);
        $accountID = $customerModel->addAccount($customerID);
        $properties = ["customerID" => $customerID,
                       "customerName" => $customerName,
                       "accountID" => $accountID];
        return $this->render("AccountAdded.twig", $properties);
      }
      */





}