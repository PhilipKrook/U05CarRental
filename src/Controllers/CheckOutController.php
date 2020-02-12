<?php

namespace RentalCar\Controllers;
use RentalCar\Models\CheckOutModel;

class CheckOutController extends AbstractController {
    public function checkOutList(): string {

      $CheckOutModel = new CheckOutModel($this->db);
      $checkouts = $CheckOutModel->checkOutList();
  
      return $this->render("CheckOut.twig", $checkouts);
    }
  }