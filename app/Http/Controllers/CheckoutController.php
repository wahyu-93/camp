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
        // instance notification 
         $notification = $request->method() == 'POST' ? new Notification() : \Midtrans\Transaction::status($request->order_id) ;
        
         // assign variable from midtrans 
         $status = $notification->transaction_status;
         $type = $notification->payment_type;
         $fraud = $notification->fraud_status;
         $order_id = $notification->order_id;       

         // get transaction id
         $order = explode('-', $order_id);
 
         // search transaction by id
         $transaction = Checkout::findOrFail($order[1]);
 
         // notificaion status
         if($status == 'capture'){
             if($type == 'credit_card'){
                 if($fraud == 'challenge'){
                     $transaction->status = 'PENDING';
                 }
                 else{
                     $transaction->status = 'SUCCESS';
                 }
             }
         }
         else if($status == 'settlement'){
             $transaction->status = 'SUCCESS';
         }
         else if($status == 'pending'){
             $transaction->status = 'PENDING';
         }
         else if($status == 'deny'){
             $transaction->status = 'PENDING';
         }
         else if($status == 'expire'){
             $transaction->status = 'CANCELED';
         }
         else if($status == 'cancel'){
             $transaction->status = 'CANCELED';
         };
         dd($transaction->status);
         // save status from notification
         $transaction->save();
         
        //  // return response json ke midtrans
        //  return response()->json([
        //      'meta'  => [
        //          'code'  => 200,
        //          'message' => 'Midtrans Transaction Success !'
        //      ]
        //  ]);

        return view('success-checkout');   
    }
}
