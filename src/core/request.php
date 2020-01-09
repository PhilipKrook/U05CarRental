<?php

  namespace main\core;

  class request {
      private $path, $form;

      public function __construct() {
          $this->path = $_SERVER["REQUEST_URI"]; //the path part of URL
          $this->form = $_POST;                  //form input
      }

      public function getPath() {
          return $this->path;
      }

      public function getForm() {
          return $this->form;
      }
  }