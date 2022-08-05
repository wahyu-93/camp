<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $checkouts = Checkout::with('user', 'camp')->whereUserId(Auth::id())->get();
        
        return view('dashboardUser', compact('checkouts'));
    }
}
