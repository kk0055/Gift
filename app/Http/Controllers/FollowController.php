<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

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

    // public function follow(Request $request,User $user)
    // {
    //     $followedUser = User::findOrFail($user);
    //     Follow::firstOrCreate([
    //         'user_id' => Auth::id(),
    //         'followed_user_id' => $followedUser->id,
    //     ]);
    //     return response()->json(['result' => true]);
    // }

    // public function unfollow(User $user)
    // {
    //     $followedUser = User::findOrFail($user);
    //     $user = Auth::user();
    //     $user->followUsers()->detach($followedUser->id);
    //     return response()->json(['result' => true]);
    // }
}
