<?php

namespace RentalCar\Controllers;
use RentalCar\Models\CustomerMainModel;


class ViewCustomersController extends AbstractController {
  public function customerList(): string {
    $customerMainModel = new CustomerMainModel($this->db);
    $customers = $customerMainModel->customerList();
    $properties = ["customers" => $customers];
    return $this->render("CustomersView.twig", $properties);
  }
}