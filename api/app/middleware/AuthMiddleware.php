<?php
namespace App\Middleware;


use App\Helpers\App;

class AuthMiddleware extends \Leaf\Middleware
{
    public function call()
    {
        if (request()->getPathinfo() != '/login') {
            if (App::authenticate()) {
                return $this->next();
            }
            else {
                response()->json(['error' => 'Not Authorized'], 401);
                exit();
            }
        }

        return $this->next();
    }
}
