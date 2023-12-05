<?php

namespace App\Controllers;

use App\Models\User;
use Leaf\Controller;

class UsersController extends Controller
{
    function index()
    {
        response()->json(User::select(['id', 'name'])->orderBy('name')->get());
    }

    function create()
    {
        $user = new User(request()->input());
        $user->save();

        response()->json($user);
    }
}
