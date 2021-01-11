<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
            'email' => 'required|exists:users',
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

        /**
     * OAuth認証先にリダイレクト
     *
     * @param str $provider
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

        /**
     * OAuth認証の結果受け取り
     *
     * @param str $provider
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $providerUser = Socialite::with($provider)->user();
        } catch(\Exception $e) {
            return redirect('/login')->with('oauth_error', '予期せぬエラーが発生しました');
        }
       
       if($email = $providerUser->getEmail()) {
           Auth::login(User::firstOrCreate([
            'email' => $email
           ],[
               'name' => $providerUser->getName()
           ]));

           return redirect($this->redirectTo);
       }else{
        return redirect('/login')->with('oauth_error', 'メールアドレスが取得できませんでした');
       }

    }
}
