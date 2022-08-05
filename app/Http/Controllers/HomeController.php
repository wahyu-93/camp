<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function dashboard()
    {   
        if(auth()->user()->is_admin){
            return redirect()->route('admin.dashboard');
        }
        else{
            return redirect()->route('user.dashboard');
        };
    }
}
