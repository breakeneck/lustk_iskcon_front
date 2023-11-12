<?php

namespace App\Helpers;
class App {
    static function loadModel($model)
    {
        $post = json_decode(file_get_contents('php://input'));
        foreach ($post as $attr => $value) {
            $model->$attr = $value;
        }
        return $model;
    }

    static function outModel($model)
    {
        foreach ($model as $attr => $value) {

        }
        //$model->getAttributes()
    }
}
