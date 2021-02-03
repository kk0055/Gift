<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function edit(User $user)
    {
       
        return view('users.profile', [
            'user' => $user,
           
        ]);
        // return ItemResource::collection($items);
    }

    public function update(Request $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            ]);

       
        return redirect()->route('users.items' ,$user)->with('info','変更しました');
    }
}
