<?php

namespace RentalCar\Controllers;

use RentalCar\Exceptions\NotFoundException;
use RentalCar\Models\CustomerModel;

class CustomerController extends AbstractController {
  public function customerAdd() {
    return $this->render("CustomerAdd.twig", []);
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
    $properties = ["customerNumber" => $customerNumber,
                   "customerName" => $customerName,
                   "customerAddress" => $customerAddress,
                   "customerPostal" => $customerPostal,
                   "customerPhone" => $customerPhone];
    return $this->render("CustomerEdit.twig", $properties);
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
    
  public function customerRemove($customerNumber) {
    $customerModel = new CustomerModel($this->db);
    $customerModel->customerRemove($customerNumber, $this->db);
    $properties = ["customerNumber" => $customerNumber];                   
    return $this->render("CustomerRemoved.twig", $properties);
  }


  /*
  public function customerAdd($customerNumber, $customerName) {
    $customerModel = new CustomerModel($this->db);
    $customerNumber = $customerModel->customerAdd($customerNumber);
    $properties = ["customerNumber" => $customerNumber,
                   "customerName" => $customerName];
    return $this->render("CustomerAdded.twig", $properties);
  }*/
}