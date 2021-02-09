<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserItemController extends Controller
{
    public function index(User $user)
    {
        
        $follows = (auth()->user()) ? auth()->user()->follow->contains($user->id): false;
        
        // dd( $follows );
        $items = $user->items()->with('user')->paginate(20);
        // dd($items);
        return view('users.index',[
            'user' => $user,
            'items' => $items ,
            'follows' => $follows
        ]);
        // dd($user);
    }

    
}
