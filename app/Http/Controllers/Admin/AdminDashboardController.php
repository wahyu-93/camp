<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $checkouts = Checkout   ::with('user', 'camp')->get();
        
        return view('dashboardUser', compact('checkouts'));
    }
}
