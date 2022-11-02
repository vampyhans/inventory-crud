<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

        //Login function
        public function login(Request $request)
        {
            $input = $request->all();
    
            $this->validate($request, [
                'email' => 'required',
                'password' => 'required',
            ]);
    
            if (auth()->attempt(['email' => $input['email'], 'password' => $input['password']])) {
                if (auth()->user()->level == 'ho') {
                    return redirect()->route('home');
                } elseif (auth()->user()->level != 'ho') {
                    Auth::logout();

                    Flasher::addError('You are not authorized to view this page.');

                    return view('auth/login')->with('loginError', 'Email or Password is wrong');
                }
            } else {
                Flasher::addError('Email or Password is wrong');
                //            return redirect()->route('login')->with('loginError', 'Email and Password are wrong');
                return view('auth/login');
            }
        }
}
