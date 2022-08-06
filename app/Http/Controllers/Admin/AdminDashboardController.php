<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\admin\afterPaid;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $checkouts = Checkout   ::with('user', 'camp')->get();
        
        return view('dashboardAdmin', compact('checkouts'));
    }

    public function updatePaid(Checkout $checkout, Request $request)
    {
        $checkout->update([
            'is_paid' => true
        ]);

        Mail::to($checkout->user->email)->send(new afterPaid($checkout));
        $request->session()->flash('paid', 'Checkout Camp with title ' . $checkout->camp->title . ' has been update!');
        return back();
    }
}
