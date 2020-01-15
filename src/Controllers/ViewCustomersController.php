<?php

namespace RentalCar\Controllers;
use RentalCar\Models\CustomerMainModel;


class ViewCustomersController extends AbstractController {
  public function customerList(): string {
    $customerModel = new CustomerMainModel($this->db);
    $customers = $customerModel->customerList();
    $properties = ["customers" => $customers];
    return $this->render("CustomersView.twig", $properties);
  }
}