<?php

namespace RentalCar\Controllers;
use RentalCar\Models\CarMainModel;

require_once __DIR__ . '/AbstractController.php';


class MainMenuController extends AbstractController {
  public function customerList(): string {
    $CarMainModel = new CarMainModel($this->db);
    $customers = $CarMainModel->customerList();
    $properties = ["customers" => $customers];
    return $this->render("MainMenu.twig", $properties);
  }
}