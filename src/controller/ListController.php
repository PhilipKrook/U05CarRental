<?php

namespace main\controller;

class ListController {
    public function listAll($twig) {
        $model = new model();
        $personArray = $model->getAll();

        $map = ["personArray" => $personArray];
        return $twig->loadTemplate("..\view\ListAllView.twig")->render($map);
    }


    public function listIndex($twig, $index) {
        $model = new model();
        $person = $model->getIndex($index);

        $map = ["index" => $index, "person" => $person];
        return $twig->loadTemplate("..\view\ListIndexView.twig")->render($map);
    }
}