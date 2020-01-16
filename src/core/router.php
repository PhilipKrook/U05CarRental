<?php

namespace RentalCar\Core;

use RentalCar\Controllers\ErrorController;
use RentalCar\Controllers\CustomerController;
use RentalCar\Utils\DependencyInjector;
    


class Router {
  private $di;
  private $routeMap;

  public function __construct(DependencyInjector $di) {
    $this->di = $di;
    $json = file_get_contents(__DIR__ . "/../../config/routes.json");
    $this->routeMap = json_decode($json, true);
  }
  
  public function route(Request $request): string {
    $result = "";
    $path = $request->getPath();

    foreach ($this->routeMap as $route => $info) {
      // echo "<pre>". print($info) . "</pre>";
      //exit;
      $map = [];
      $params = isset($info["params"]) ? $info["params"] : null;      
      if ($this->match($route, $path, $params, $map)) {
        $controllerName = '\RentalCar\Controllers\\' .
        $info["controller"] . "Controller";
        $controller = new $controllerName($this->di, $request);
        $methodName = $info["method"];
        return call_user_func_array([$controller, $methodName], $map);
      }
    }
  }

  private function match($route, $path, $params, &$map) {      
    $routeArray = explode("/", $route);
    $pathArray = explode("/", $path);
    $routeSize = count($routeArray);
    $pathSize = count($pathArray);    
    
    if ($routeSize === $pathSize) {
      for ($index = 0; $index < $routeSize; ++$index) {
        
        $routeName = $routeArray[$index];
        $pathName = $pathArray[$index];
        if ((strlen($routeName) > 0) && $routeName[0] === ":") {
          $key = substr($routeName, 1);
          $value = $pathName;
          $map[$key] = $value;

          if (($params != null) && isset($params[$key]) &&
              !$this->typeMatch($value, $params[$key])) {
            return false;
          }
          
        }
        else if ($routeName !== $pathName) {
          return false;
        }
      }
      
      return true;
    }
    
    return false;
  }

  
  private function typeMatch($value, $type) {
    switch ($type) {
      case "number": 
        return true;
        //return preg_match('/^[0-9]+$/', $value);
    
      case "string":
        return preg_match('/^[%a-zA-Z0-9]+$/', $value);
    }

    return true;
  }
}