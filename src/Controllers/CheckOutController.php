<?php

namespace RentalCar\Controllers;
use RentalCar\Models\CheckOutModel;

class CheckOutController extends AbstractController {
    public function checkOutList(): string {

      $CheckOutModel = new CheckOutModel($this->db);
      $checkouts = $CheckOutModel->checkOutList();
  
      return $this->render("CheckOut.twig", $checkouts);
    }

    public function checkOutDone($carID, $customerID) {

      $checkouts = ["carID" => $carID,
                   "customerID" => $customerID];

      $CheckOutModel = new CheckOutModel($this->db);
      $checkouts = $CheckOutModel->checkOutList();
  
      return $this->render("CheckOutDone.twig", $checkouts);
    }

  }