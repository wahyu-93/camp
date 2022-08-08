@extends('layout.app')

@section('title', 'My Dashboard')

@section('content')
<section class="dashboard my-5">
    <div class="container">
        <div class="row text-left">
            <div class=" col-lg-12 col-12 header-wrap mt-4">
                <p class="story">
                    DASHBOARD
                </p>
                <h2 class="primary-header ">
                    My Bootcamps
                </h2>
            </div>
        </div>
        <div class="row my-5">
            @include('components.alert')
            <table class="table">
                <tbody>
                    @forelse ($checkouts as $checkout)
                        <tr class="align-middle">
                            <td width="18%">
                                <img src="{{ asset('assets/images/item_bootcamp.png') }}" height="120" alt="">
                            </td>
                            
                            <td>
                                <p class="mb-2">
                                    <strong>{{ $checkout->camp->title }}</strong>
                                </p>
                                <p>
                                    {{ date('Y-m-d', strtotime($checkout->created_at)) }}
                                </p>
                            </td>
                            
                            <td>
                                <strong>{{ number_format($checkout->total) }} K</strong>
                                <span class="badge bg-info text-dark">Disc {{ $checkout->discount_percentage }} %</span>
                            </td>
                            
                            <td>
                                @if($checkout->payment_status=="paid")
                                    <strong class="text-success">Payment Success</strong>                                        
                                @else
                                    <strong>Waiting for Payment</strong>
                                @endif
                            </td>

                            @if (auth()->user()->is_admin)
                                <td>
                                    <strong>{{ auth()->user()->name }}</strong>
                                </td>    
                            @endif
                            
                            <td>
                                @if($checkout->payment_status!="paid")
                                    <a href="{{ $checkout->midtrans_url }}" class="btn btn-primary btn-sm">Pay Here</a>
                                @endif

                                <a href="" class="btn btn-primary btn-sm">
                                    Contact Support
                                </a>
                            </td>
                        </tr>
                    @empty
                        <p class="text-danger">empty checkouts</p>
                    @endforelse
                    
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection