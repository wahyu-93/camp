<?php

namespace App\Http\Controllers;

use App\Mail\user\afterRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginGoogleCallback()
    {
        $callback = Socialite::driver('google')->stateless()->user();
        
        $data = [
            'name'  => $callback->getName(),
            'email' => $callback->getEmail(),
            'avatar' =>  $callback->getAvatar(),
            'email_verified_at' => date('Y-m-d H:i:s', time()),
        ];

        // $user = User::firstOrCreate(['email' => $data['email']], $data);
        
        $user = User::whereEmail($data['email'])->first();
        if(!$user){
            // simpan 
            $user = User::create($data);

            // mail
            Mail::to($user->email)->send(new afterRegister($user));
        };

        Auth::login($user, true);

        return redirect()->route('home');
    }
}
