<?php

namespace RentalCar\Controllers;
use RentalCar\Models\CheckOutModel;

class CheckOutController extends AbstractController {
    public function checkOutList(): string {

      $CheckOutModel = new CheckOutModel($this->db);
      $checkouts = $CheckOutModel->checkOutList();
  
      return $this->render("CheckOut.twig", $checkouts);
    }

    public function checkOutDone() {

      $checkouts = ["carID" => $_POST['cars'],
                   "customerID" => $_POST['customers']];

      $CheckOutModel = new CheckOutModel($this->db);
      $checkouts = $CheckOutModel->checkOutList();
  
      return $this->render("CheckOutDone.twig", $checkouts);
    }

  }