<?php

  namespace main;

  #use main\ListController;
  require_once 'ListController.php';
  #use main\InputController;
  require_once 'InputController.php';
  #use main\MainController;
  require_once 'MainController.php';
  require_once 'model.php';


  class router {
      public function route($request, $twig) {
          $path = $request->getPath();
          $form = $request->getForm();

          if ($path == "/listAll") {
              $controller = new ListController();
              return $controller->listAll($twig);
          }
          else if ($path == "/inputIndex") {
              $controller = new InputController();
              return $controller->inputIndex($twig);
          }
          else if ($path =="/listIndex") {
              $controller = new ListController();
              $index = $form["index"];
              return $controller->listIndex($twig, $index);
          }
          else if ($path =="/") {
              $controller = new MainController();
              return $controller->mainMenu($twig);
          }
          else {
              return "Router Error!";
          }
      }
  }