<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\Checkout;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(Camp $camp, Request $request)
    {
        // validasi jika sudah teregister di camp
        if($camp->isRegistered){
            $request->session()->flash('error', 'you have already registered on ' . $camp->title . ' camp');
            return redirect()->route('dashboard');
        }

        return view('checkout', compact('camp'));
    }

    public function store(Request $request, Camp $camp)
    {
        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|email',
            'occupation' => 'required',
            'card-number' => 'required',
            'expired'   => 'required',
            'cvc'       => 'required'
        ]);

        // nyimpan ke table checkout
        auth()->user()->checkouts()->create([
            'camp_id'     => $camp->id, 
            'card_number' => $request['card-number'],
            'expired'     => $request['expired'],
            'cvc'         => $request['cvc'],
        ]);

        // sipan occupation table user
        auth()->user()->update([
            'occupation'    => $request['occupation']
        ]);

        return view('success-checkout');
        
    }
}
