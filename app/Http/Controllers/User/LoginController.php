<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credential = $request->only('email', 'password');

        if (Auth::attempt($credential)){
            $request->session()->regenerate();
    
            return redirect()->intended('dashboard');
        };

        return back()->with('error', 'Email atau Password Salah');

    }
}
