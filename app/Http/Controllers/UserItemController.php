<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserItemController extends Controller
{
    public function index(User $user)
    {
        $items = $user->items()->with('user')->paginate(20);
        // dd($items);
        return view('users.index',[
            'user' => $user,
            'items' => $items 
        ]);
        // dd($user);
    }

    
}
