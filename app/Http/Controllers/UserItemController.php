<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserItemController extends Controller
{
    public function index(User $user)
    {
        dd($user);
    }
}
