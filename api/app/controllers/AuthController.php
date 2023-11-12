<?php

namespace App\Controllers;

use App\Helpers\App;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        print_r(request()->getPath());
    }

    public function login()
    {
        $loggedUser = App::loadModel(new User());

        $user = db()->select('users')
            ->where('email', $loggedUser->email)
            ->where('password', $loggedUser->password)
            ->obj();
        if (isset($user->id)) {
            response()->json(['user' => $user]);
        }
        else {
            response()->json(['error' => 'User not found']);
        }
    }

    public function logout()
    {
//        print_r(request()->getPath());
        response()->json([
            'message' => 'You are logged out'
        ]);
    }
}
