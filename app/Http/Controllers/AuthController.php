<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function doLogin(Request $request) {

        $users = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        if(Auth::attempt($users)) {

            $request->session()->regenerate();
            return redirect()->intended(route('blog.index'));

        }

        return to_route('auth.login')->withErrors([
            'email' => 'Email Invalid !'
        ])->onlyInput('email');

    }

    public function logout() {
        Auth::logout();

        return redirect()->route('auth.login');
    }
}
