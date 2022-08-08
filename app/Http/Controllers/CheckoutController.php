<?php

namespace App\Http\Controllers;

use App\Mail\checkout\afterCheckout;
use App\Models\Camp;
use App\Models\Checkout;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;
use Midtrans\Notification;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.sis3ds');
    }

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
         $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,'.auth()->user()->id,
            'occupation' => 'required',
            'phone' => 'required|integer',
            'address' => 'required'
        ]);

        // nyimpan ke table checkout
        $checkout = auth()->user()->checkouts()->create([
            'camp_id'     => $camp->id, 
        ]);

        // sipan occupation table user
        auth()->user()->update([
            'occupation' => $request->occupation,
            'phone' => $request->phone,
            'address' => $request->address
        ]);


        // midtrans
        $this->getSnapRedirect($checkout);
        // $this->midtransCallback();

        // kirim email
        Mail::to(auth()->user()->email)->send(new afterCheckout($checkout));

        return view('success-checkout');   
    }

    public function getSnapRedirect(Checkout $checkout)
    {
        $orderId = $checkout->id .'-'. Str::random(5);
        $price = $checkout->camp->price * 1000;

        $checkout->midtrans_booking_code = $orderId;

        $transaction_detail = [
            'order_id' => $orderId,
            'gross_amount' => $price,
        ];

        $items_detail[] = [
            'id'    => $orderId,
            'price' => $price,
            'quantity' => 1,
            'name'  => "payment for {$checkout->camp->title} Camp"
        ];

        $userData = [
            'first_name' => $checkout->user->name,
            'last_name' => '',
            'address' => $checkout->user->address,
            'city' => '',
            'postal_code' => '',
            'phone' => $checkout->user->phone,
            'country_code' => 'IDN'
        ];

        $customer_details = [
            'first_name' => $checkout->user->name,
            'last_name' => '',
            'email' => $checkout->user->email,
            'phone' => $checkout->user->phone,
            'billing_address' => $userData   
        ];

        $midtrans_param = [
            'transaction_details'    => $transaction_detail,
            'customer_details'       => $customer_details,
            'item_details'           => $items_detail
        ];

        try {
            $paymentUrl = \Midtrans\Snap::createTransaction(    $midtrans_param)->redirect_url;
            $checkout->midtrans_url = $paymentUrl;
            $checkout->save();
        } catch (Exception $e) {
            return false;
        }
    }

    public function midtransCallback(Request $request)
    { 
        $notif = $request->method() == 'POST' ? new Notification() : \Midtrans\Transaction::status($request->order_id);

        $transaction_status = $notif->transaction_status;
        $fraud = $notif->fraud_status;

        $transaction_id = explode('-', $notif->order_id)[0];
       $checkout = Checkout::find($transaction_id);

        if ($transaction_status == 'capture') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'challenge'
               $checkout->payment_status = 'pending';
            }
            else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'success'
               $checkout->payment_status = 'paid';
            }
        }
        else if ($transaction_status == 'cancel') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'failure'
               $checkout->payment_status = 'failed';
            }
            else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'failure'
               $checkout->payment_status = 'failed';
            }
        }
        else if ($transaction_status == 'deny') {
            // TODO Set payment status in merchant's database to 'failure'
           $checkout->payment_status = 'failed';
        }
        else if ($transaction_status == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
           $checkout->payment_status = 'paid';
        }
        else if ($transaction_status == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
           $checkout->payment_status = 'pending';
        }
        else if ($transaction_status == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
           $checkout->payment_status = 'failed';
        }

       $checkout->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Payment success'
        ]);
    }
}
