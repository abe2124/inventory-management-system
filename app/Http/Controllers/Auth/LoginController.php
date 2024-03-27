<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user_role = Auth::user()->role;
            switch ($user_role) {
                case 1:
                    return redirect('/admin');
                case 2:
                    return redirect('/nurse');
                case 0:
                    return redirect('/director');
                default:
                    Auth::logout();
                    return redirect('/login')->with('error', 'Oops, something went wrong!');
            }
        }

        return redirect('/login')->with('error', 'Invalid credentials');
    }
}
