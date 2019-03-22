<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    //
    public function getUserlist()
    {
        return ['result' => true, 'users' => User::all()];
    }
}
