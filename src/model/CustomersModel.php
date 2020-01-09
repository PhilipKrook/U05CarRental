<?php

  namespace main\model;

  class CustomersModel {
      private $customersArray;

      public function __construct() {
          $adam = ["name" => "Adam","address" => "Stora gatan 1", "phone" => "0123456789"];
          $sune = ["name" => "Sune","address" => "Lilla gatan 22", "phone" => "9876543210"];
          $lennart = ["name" => "Lennart","address" => "Stora torget 3", "phone" => "1029384756"];
          $greta = ["name" => "Greta","address" => "Lilla gatan 1", "phone" => "0192837465"];
          $daniel = ["name" => "Daniel","address" => "Gammla gatan 1", "phone" => "6574839201"];
          $this->customersArray = [$adam, $sune, $lennart, $greta, $daniel];
      }

      public function getAll() {
          return $this->customersArray;
      }

      public function getIndex($index) {
          if ($index < count($this->customersArray)) {
              return $this->customersArray[$index];
          }
          else {
              return null;
          }
      }

  }