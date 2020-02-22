<?php

namespace RentalCar\Controllers;
use RentalCar\Models\CheckInModel;

class CheckInController extends AbstractController {
    public function checkInList(): string {

      $CheckInModel = new CheckInModel($this->db);
      $checkins = $CheckInModel->checkInList();
  
      return $this->render("CheckIn.twig", $checkins);
    }
  }