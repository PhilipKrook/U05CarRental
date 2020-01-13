<?php

Makespace RentalCar\Controllers;

use RentalCar\Exceptions\NotFoundException;
use RentalCar\Models\CarModel;

class CarController extends AbstractController {
  public function addCar() {
    return $this->render("AddCar.twig", []);
  }
    
  public function carAdded() {
    $form = $this->request->getForm();
    $carMake = $form["carMake"];
    $carID = $form["carID"];
    $carColour = $form["carcolour"];
    $carYear = $form["carYear"];
    $carPrice = $form["carPrice"];
    $carModel = new CarModel($this->db);
    $carID = $carMake->addcar($carMake, $carID, $carColour, $carYear, $carPrice);
    $properties = ["carID" => $carID,
                   "carMake" => $carMake,                   
                   "carColour" => $carColour,
                   "carYear" => $carYear,
                   "carPrice" => $carPrice];
    return $this->render("carAdded.twig", $properties);
  }    

  public function editcar($carMake, $carColour, $carYear, $carPrice) {
    //$carMake = $map["carMake"];
    //$carID = $map["carID"];      
    $properties = ["carMake" => $carMake,
                   "carColour" => $carColour,
                   "carYear" => $carYear,
                   "carPrice" => $carPrice];
    return $this->render("CarEdit.twig", $properties);
  }
    
  public function carEdited($carOldMake, $carOldColour, $carOldYear, $carOldPrice) {
    $form = $this->request->getForm();
    $carNewMake = $form["carMake"];
    $carNewColour = $form["carColour"];
    $carNewYear = $form["carYear"];
    $carNewPrice = $form["carPrice"];
    echo $carOldMake;
    $carMake = new carModel($this->db);
    $carMake->editcar($carID, $carNewMake, $carNewColour, $carNewYear, $carNewPrice);
    $properties = ["carID" => $carID,
                   "carOldMake" => $carOldMake,
                   "carNewMake" => $carNewMake,
                   "carOldColour" => $carOldColour,
                   "carNewColour" => $carNewColour,
                   "carOldYear" => $carOldYear,
                   "carNewYear" => $carNewYear,
                   "carOldPrice" => $carOldPrice,
                   "carNewPrice" => $carNewPrice];
    return $this->render("carEdited.twig", $properties);
  }    
    
  public function removecar($carID, $carMake) {
    $carMake = new carModel($this->db);
    $IDOfAccounts = $carMake->removecar($carID);
    $properties = ["carID" => $carID,
                   "carMake" => $carMake,
                   "IDOfAccounts" => $IDOfAccounts];
    return $this->render("carRemoved.twig", $properties);
  }


/*
  public function addAccount($carID, $carMake) {
    $carModel = new carModel($this->db);
    $accountID = $carModel->addAccount($carID);
    $properties = ["carID" => $carID,
                   "carMake" => $carMake,
                   "accountID" => $accountID];
    return $this->render("AccountAdded.twig", $properties);
  }
  */


}