<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['update', 'edit']);
    }

    public function index(User $user  )
    {
       
        return view('main', [
            'user' => $user,
           
        ]);
        // return ItemResource::collection($items);
    }
}
