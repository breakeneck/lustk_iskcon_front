<?php

namespace App\Helpers;
use App\Models\User;

class App {
    static $user;
    static function loadModel($model, $data)
    {
        foreach ($data as $attr => $value) {
            $model->$attr = $value;
        }
        return $model;
    }

    static function authenticate()
    {
        if (! request()->hasHeader('Authorization')) {
            return false;
        }
        $bearer = request()->headers('Authorization');
        $access_token = trim(substr($bearer, strlen('Bearer ')));
        $rawUser = db()->select('users')->where('access_token', $access_token)->assoc();
        if ($rawUser) {
            self::$user = self::loadModel(new User(), $rawUser);
        }
        return boolval($rawUser);
    }
}
