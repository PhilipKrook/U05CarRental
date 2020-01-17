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
    $customerID = $form["customerID"];
    $customerName = $form["customerName"];
    $customerAddress = $form["customerAddress"];
    $customerPostal = $form["customerPostal"];
    $customerPhone = $form["customerPhone"];
    $customerModel = new CustomerModel($this->db);
    $customerModel = $customerModel->customerAdd($customerID, $customerName, $customerAddress, $customerPostal, $customerPhone);
    $properties = ["customerID" => $customerID,
                   "customerName" => $customerName,
                   "customerAddress" => $customerAddress,
                   "customerPostal" => $customerPostal,
                   "customerPhone" => $customerPhone];
    return $this->render("CustomerAdded.twig", $properties);
  }    

  public function customerEdit($customerID, $customerName, $customerAddress, $customerPostal, $customerPhone) {      
    $properties = ["customerID" => $customerID,
                   "customerName" => $customerName,
                   "customerAddress" => $customerAddress,
                   "customerPostal" => $customerPostal,
                   "customerPhone" => $customerPhone];
    return $this->render("CustomerEdit.twig", $properties);
  }
    
  public function customerEdited($customerID, $customerOldName, $customerOldAddress, $customerOldPostal, $customerOldPhone) {
    $form = $this->request->getForm();
    $customerNewName = $form["customerName"];
    $customerNewAddress = $form["customerAddress"];
    $customerNewPostal = $form["customerPostal"];
    $customerNewPhone = $form["customerPhone"];
    $customerModel = new CustomerModel($this->db);
    $customerModel->customerEdit($customerID, $customerNewName, $customerNewAddress, $customerNewPostal, $customerNewPhone);
    $properties = ["customerID" => $customerID,
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
    
  public function customerRemove($customerID) {
    $customerModel = new CustomerModel($this->db);
    $customerModel->customerRemove($customerID, $this->db);
    $properties = ["customerID" => $customerID];                   
    return $this->render("CustomerRemoved.twig", $properties);
  }
}