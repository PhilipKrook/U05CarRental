<?php

namespace RentalCar\Controllers;
use RentalCar\Models\CarMainModel;

class ViewCarsController extends AbstractController {
  public function carList(): string {
    $carMainModel = new CarMainModel($this->db);
    $cars = $carMainModel->carList();
    $properties = ["cars" => $cars];
    return $this->render("CarsView.twig", $properties);
  }
}