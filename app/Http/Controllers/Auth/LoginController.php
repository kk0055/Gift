<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
class LoginController extends Controller
{
 

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function index()
    {
      return view('auth.login');
    }
  
    public function store(Request $request)
    {
       
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
         ]);

        if (! auth()->attempt($request->only('email','password'),$request->remember))
        {
            return back()->with('status', 'invalid login details');
        }
        ;
        return redirect()->route('main');
    }

    public function logOut()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
