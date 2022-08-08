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
                                <input type="text" class="form-control" id="occupation" name="occupation" value="{{ auth()->user()->occupation ?? old('occupation') }}">
                                
                                @error('occupation')
                                    <small>
                                        <span class="text-danger">{{ $message }}</span>
                                    </small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone ?? old('phone') }}">
                                
                                @error('phone')
                                    <small>
                                        <span class="text-danger">{{ $message }}</span>
                                    </small>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ auth()->user()->address ?? old('address') }}">
                                
                                @error('address')
                                    <small>
                                        <span class="text-danger">{{ $message }}</span>
                                    </small>
                                @enderror
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