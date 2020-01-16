<?php

namespace RentalCar\Controllers;
use RentalCar\Models\CheckOutModel;

class CheckOutController extends AbstractController {
    public function checkOutList(): string {
      $CheckOutModel = new CheckOutModel($this->db);
      $checkouts = $CheckOutModel->checkOutList();
      $properties = ["checkouts" => $checkouts];
      return $this->render("CheckOut.twig", $properties);
    }
  }