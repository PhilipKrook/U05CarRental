<?php

namespace main;

class MainController {
    public function mainMenu($twig) {
        return $twig->loadTemplate("MainMenuView.twig")->render([]);
    }
}