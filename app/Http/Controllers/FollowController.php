<?php

namespace App\Http\Controllers;

use App\Models\User;


class FollowController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function follow(User $user)
    {
       return auth()->user()->follow()->toggle($user->id);
    }

   
}
