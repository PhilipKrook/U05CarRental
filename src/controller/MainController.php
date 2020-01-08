<?php

namespace main\controller;

class MainController {
    public function mainMenu($twig) {
        return $twig->loadTemplate("..\view\MainMenuView.twig")->render([]);
    }
}