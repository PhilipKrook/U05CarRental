<?php

namespace main;

class InputController {
    public function inputIndex($twig) {
        return $twig->loadTemplate("InputIndexView.twig")->render([]);
    }
}