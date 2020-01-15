<?php

namespace RentalCar\Controllers;
use RentalCar\Models\CustomerMainModel;
use RentalCar\Models\CarMainModel;
use RentalCar\Models\CheckInModel;
use RentalCar\Models\CheckOutModel;

require_once __DIR__ . '/AbstractController.php';


class MainMenuController extends AbstractController { 
  public function customerList(): string {
    $CustomerMainModel = new CustomerMainModel($this->db);
    $customers = $CustomerMainModel->customerList();
    $properties = ["customers" => $customers];
    return $this->render("MainMenu.twig", $properties);
  }
  public function carList(): string {
    $CarMainModel = new CarMainModel($this->db);
    $cars = $CarMainModel->carList();
    $properties = ["cars" => $cars];
    return $this->render("MainMenu.twig", $properties);
  }
}