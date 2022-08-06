<?php

namespace App\Http\Controllers;

use App\Mail\checkout\afterCheckout;
use App\Models\Camp;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function checkout(Camp $camp, Request $request)
    {
        // validasi jika sudah teregister di camp
        if($camp->isRegistered){
            $request->session()->flash('error', 'you have already registered on ' . $camp->title . ' camp');
            return redirect()->route('user.dashboard');
        }

        return view('checkout', compact('camp'));
    }

    public function store(Request $request, Camp $camp)
    {
        $expiredValidation = date('Y-m', time());
        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,'.auth()->user()->id,
            'occupation' => 'required',
        ]);

        // nyimpan ke table checkout
        $checkout = auth()->user()->checkouts()->create([
            'camp_id'     => $camp->id, 
        ]);

        // sipan occupation table user
        auth()->user()->update([
            'occupation'    => $request['occupation']
        ]);

        // kirim email
        Mail::to(auth()->user()->email)->send(new afterCheckout($checkout));

        return view('success-checkout');
        
    }
}
