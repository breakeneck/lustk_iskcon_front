<?php

namespace App\Controllers;

use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        print_r(request()->getPath());
    }

    public function login()
    {
        $user = new User(request()->input());

        $loggedUser = db()->select('users')
            ->where('email', $user->email)
            ->where('password', $user->password)
            ->obj();
        if (isset($loggedUser->id)) {
            response()->json(['user' => $loggedUser]);
        }
        else {
            response()->json(['error' => 'User not found']);
        }
    }

    public function logout()
    {
        response()->json([
            'message' => 'You are logged out'
        ]);
    }
}
