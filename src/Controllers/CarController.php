<?php

namespace RentalCar\Controllers;

use RentalCar\Exceptions\NotFoundException;
use RentalCar\Models\CarModel;

class CarController extends AbstractController {
  public function carAdd() {
    return $this->render("CarAdd.twig", []);
  }
    
  public function carAdded() {
    $form = $this->request->getForm();
    $carID = $form["carID"];
    $carMake = $form["carMake"];    
    $carColour = $form["carColour"];
    $carYear = $form["carYear"];
    $carPrice = $form["carPrice"];
    $carModel = new CarModel($this->db);
    $carModel = $carModel->carAdd($carID, $carMake, $carColour, $carYear, $carPrice);
    $properties = ["carID" => $carID,
                   "carMake" => $carMake,                                    
                   "carColour" => $carColour,
                   "carYear" => $carYear,
                   "carPrice" => $carPrice];
    return $this->render("CarAdded.twig", $properties);
  }

  public function carEdit($carID, $carMake, $carColour, $carYear, $carPrice) {
    $properties = ["carID" => $carID,
                   "carMake" => $carMake,
                   "carColour" => $carColour,
                   "carYear" => $carYear,
                   "carPrice" => $carPrice];
    return $this->render("CarEdit.twig", $properties);
  }
    
  public function carEdited($carOldID, $carOldMake, $carOldColour, $carOldYear, $carOldPrice) {
    $form = $this->request->getForm();
    $carNewID = $form["carID"];
    $carNewMake = $form["carMake"];
    $carNewColour = $form["carColour"];
    $carNewYear = $form["carYear"];
    $carNewPrice = $form["carPrice"];
    $carModel = new carModel($this->db);
    $carModel->carEdit($carNewID, $carNewMake, $carNewColour, $carNewYear, $carNewPrice);
    $properties = ["carOldMake" => $carOldMake,
                   "carNewMake" => $carNewMake,
                   "carOldColour" => $carOldColour,
                   "carNewColour" => $carNewColour,
                   "carOldYear" => $carOldYear,
                   "carNewYear" => $carNewYear,
                   "carOldPrice" => $carOldPrice,
                   "carNewPrice" => $carNewPrice];
    return $this->render("CarEdited.twig", $properties);
  }    
    
  public function carRemove($carID) {
    $carModel = new carModel($this->db);
    $carModel->carRemove($carID, $this->db);
    $properties = ["carID" => $carID];
    return $this->render("CarRemoved.twig", $properties);
  }
}