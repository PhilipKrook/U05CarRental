<?php

namespace RentalCar\Controllers;

use RentalCar\Exceptions\NotFoundException;
use RentalCar\Models\CustomerModel;

class CustomerController extends AbstractController {
  public function customerAdd() {
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
    $customerNumber = $customerModel->customerAdd($customerName, $customerID, $customerAddress, $customerPostal, $customerPhone);
    $properties = ["customerNumber" => $customerNumber,
                   "customerName" => $customerName,
                   "customerID" => $customerID,
                   "customerAddress" => $customerAddress,
                   "customerPostal" => $customerPostal,
                   "customerPhone" => $customerPhone];
    return $this->render("CustomerAdded.twig", $properties);
  }    

  public function customerEdit($customerNumber, $customerName, $customerAddress, $customerPostal, $customerPhone) {
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
    $customerModel->customerEdit($customerNumber, $customerNewName, $customerNewAddress, $customerNewPostal, $customerNewPhone);
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
    
  public function customerRemove($customerNumber, $customerName) {
    $customerModel = new CustomerModel($this->db);
    $numberOfAccounts = $customerModel->customerRemove($customerNumber);
    $properties = ["customerNumber" => $customerNumber,
                   "customerName" => $customerName,
                   "numberOfAccounts" => $numberOfAccounts];
    return $this->render("CustomerRemoved.twig", $properties);
  }

  public function carAdd($customerNumber, $customerName) {
    $customerModel = new CustomerModel($this->db);
    $accountNumber = $customerModel->carAdd($customerNumber);
    $properties = ["customerNumber" => $customerNumber,
                   "customerName" => $customerName,
                   "accountNumber" => $accountNumber];
    return $this->render("AccountAdded.twig", $properties);
  }
}