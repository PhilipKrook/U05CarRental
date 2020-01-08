<?php

namespace main\controller;

class InputController {
    public function inputIndex($twig) {
        return $twig->loadTemplate("..\view\InputIndexView.twig")->render([]);
    }
}