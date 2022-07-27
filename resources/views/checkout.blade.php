@extends('layout.app')

@section('title', 'Checkout')

@section('content')

<section class="checkout">
    <div class="container">
        <div class="row text-center pb-70">
            <div class="col-lg-12 col-12 header-wrap">
                <p class="story">
                    YOUR FUTURE CAREER
                </p>
                <h2 class="primary-header">
                    Start Invest Today
                </h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9 col-12">
                <div class="row">
                    <div class="col-lg-5 col-12">
                        <div class="item-bootcamp">
                            <img src="{{ asset('assets/images/item_bootcamp.png') }}" alt="" class="cover">
                            <h1 class="package">
                                {{ $camp->title }}
                            </h1>
                            <p class="description">
                                {{$camp->description  }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-lg-1 col-12"></div>
                   
                    <div class="col-lg-6 col-12">
                        <form action="{{ route('checkout.store', $camp) }}" class="basic-form" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}">
                                
                                @error('name')
                                    <small>
                                        <span class="text-danger">{{ $message }}</span>
                                    </small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}">
                                
                                @error('email')
                                    <small>
                                        <span class="text-danger">{{ $message }}</span>
                                    </small>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="occupation" class="form-label">Occupation</label>
                                <input type="text" class="form-control" id="occupation" name="occupation">
                                
                                @error('occupation')
                                    <small>
                                        <span class="text-danger">{{ $message }}</span>
                                    </small>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="card-number" class="form-label">Card Number</label>
                                <input type="number" class="form-control" id="card-number" name="card-number">
                                
                                @error('card-number')
                                    <small>
                                        <span class="text-danger">{{ $message }}</span>
                                    </small>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <label for="expired" class="form-label">Expired</label>
                                        <input type="month" class="form-control" id="expired" name="expired">
                                       
                                        @error('expired')
                                            <small>
                                                <span class="text-danger">{{ $message }}</span>
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label for="cvc" class="form-label">CVC</label>
                                        <input type="text" class="form-control" id="cvc" name="cvc" maxlength="3">
                                      
                                        @error('cvc')
                                            <small>
                                                <span class="text-danger">{{ $message }}</span>
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="w-100 btn btn-primary">Pay Now</button>
                            <p class="text-center subheader mt-4">
                                <img src="{{ asset('assets/images/ic_secure.svg') }}" alt=""> Your payment is secure and encrypted.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection