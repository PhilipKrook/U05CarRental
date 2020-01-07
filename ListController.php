<?php

namespace main;

class ListController {
    public function listAll($twig) {
        $model = new model();
        $personArray = $model->getAll();

        $map = ["personArray" => $personArray];
        return $twig->loadTemplate("ListAllView.twig")->render($map);
    }


    public function listIndex($twig, $index) {
        $model = new model();
        $person = $model->getIndex($index);

        $map = ["index" => $index, "person" => $person];
        return $twig->loadTemplate("ListIndexView.twig")->render($map);
    }
}