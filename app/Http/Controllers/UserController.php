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
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|',
         ],
         [
                'name.required' => 'ニックネームは必須項目です。',
                'email.required'  => 'メールアドレスは必須項目です。',
         ]);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            ]);

       
        return redirect()->route('users.items' ,$user)->with('info','変更しました');
    }
}
