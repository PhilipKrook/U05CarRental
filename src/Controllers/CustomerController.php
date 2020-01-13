<?php

namespace Bank\Controllers;

use Bank\Exceptions\NotFoundException;
use Bank\Models\CustomerModel;

class CustomerController extends AbstractController {
  public function addCustomer() {
    return $this->render("AddCustomer.twig", []);
  }
    
  public function customerAdded() {
    $form = $this->request->getForm();
    $customerName = $form["customerName"];
    $customerID = $form["customerID"];
    $customerAddress = $form["customerAddress"];
    $customerPostal = $form["customerPostal"];
    $customerPhone = $form["customerPhone"];
    $customerModel = new CustomerModel($this->db);
    $customerNumber = $customerModel->addCustomer($customerName, $customerID, $customerAddress, $customerPostal, $customerPhone);
    $properties = ["customerNumber" => $customerNumber,
                   "customerName" => $customerName,
                   "customerID" => $customerID,
                   "customerAddress" => $customerAddress,
                   "customerPostal" => $customerPostal,
                   "customerPhone" => $customerPhone];
    return $this->render("CustomerAdded.twig", $properties);
  }    

  public function editCustomer($customerNumber, $customerName, $customerAddress, $customerPostal, $customerPhone) {
    //$customerName = $map["customerName"];
    //$customerNumber = $map["customerNumber"];      
    $properties = ["customerNumber" => $customerNumber,
                   "customerName" => $customerName,
                   "customerAddress" => $customerAddress,
                   "customerPostal" => $customerPostal,
                   "customerPhone" => $customerPhone];
    return $this->render("EditCustomer.twig", $properties);
  }
    
  public function customerEdited($customerNumber, $customerOldName, $customerOldAddress, $customerOldPostal, $customerOldPhone) {
    $form = $this->request->getForm();
    $customerNewName = $form["customerName"];
    $customerNewAddress = $form["customerAddress"];
    $customerNewPostal = $form["customerPostal"];
    $customerNewPhone = $form["customerPhone"];
    echo $customerOldName;
    $customerModel = new CustomerModel($this->db);
    $customerModel->editCustomer($customerNumber, $customerNewName, $customerNewAddress, $customerNewPostal, $customerNewPhone);
    $properties = ["customerNumber" => $customerNumber,
                   "customerOldName" => $customerOldName,
                   "customerNewName" => $customerNewName,
                   "customerOldAddress" => $customerOldAddress,
                   "customerNewAddress" => $customerNewAddress,
                   "customerOldPostal" => $customerOldPostal,
                   "customerNewPostal" => $customerNewPostal,
                   "customerOldPhone" => $customerOldPhone,
                   "customerNewPhone" => $customerNewPhone];
    return $this->render("CustomerEdited.twig", $properties);
  }    
    
  public function removeCustomer($customerNumber, $customerName) {
    $customerModel = new CustomerModel($this->db);
    $numberOfAccounts = $customerModel->removeCustomer($customerNumber);
    $properties = ["customerNumber" => $customerNumber,
                   "customerName" => $customerName,
                   "numberOfAccounts" => $numberOfAccounts];
    return $this->render("CustomerRemoved.twig", $properties);
  }

  public function addAccount($customerNumber, $customerName) {
    $customerModel = new CustomerModel($this->db);
    $accountNumber = $customerModel->addAccount($customerNumber);
    $properties = ["customerNumber" => $customerNumber,
                   "customerName" => $customerName,
                   "accountNumber" => $accountNumber];
    return $this->render("AccountAdded.twig", $properties);
  }
}