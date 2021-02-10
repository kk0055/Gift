<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;



class UserItemController extends Controller
{
    public function index(User $user)
    {
        //フォローしてるかどうか
        $follows = (auth()->user()) ? auth()->user()->follow->contains($user->id): false;
        
        //フォローしている数
        $following = Follow::where('user_id', $user->id)->get();
        $numberOfFollowing = count( $following );
       
         //フォローされている数
        $followed = Follow::where('followed_user_id', $user->id)->get();
        $numberOfFollowed = count( $followed );
        // dd($numberOfFollowing);
        $items = $user->items()->with('user')->paginate(20);
       
        return view('users.index',[
            'user' => $user,
            'items' => $items ,
            'follows' => $follows,
            'numberOfFollowing' => $numberOfFollowing,
            'numberOfFollowed' => $numberOfFollowed
        ]);
        
    }

    
}
