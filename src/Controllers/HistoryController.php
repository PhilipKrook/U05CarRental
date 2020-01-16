<?php

namespace RentalCar\Controllers;
use RentalCar\Models\HistoryModel;

class HistoryController extends AbstractController {
    public function historyList(): string {
      $HistoryModel = new historyModel($this->db);
      $historylog = $HistoryModel->historyList();
      $properties = ["historylog" => $historylog];
      return $this->render("History.twig", $properties);
    }
  }