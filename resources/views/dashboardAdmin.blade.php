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
                    List Bootscamp User
                </h2>
            </div>
        </div>
        <div class="row my-5">
            @include('components.alert')
            <table class="table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Camp</th>
                        <th>Price</th>
                        <th>Register Data</th>
                        <th>Paid Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($checkouts as $checkout)
                    <tr>
                        <td>{{ $checkout->user->name }}</td>
                        <td>{{ $checkout->camp->title }}</td>
                        <td>{{ $checkout->camp->price }}</td>
                        <td>{{ date('M d Y', strtotime($checkout->created_at)) }}</td>
                        <td>
                            @if($checkout->is_paid)
                                <span class="badge bg-success">Paid</span>
                            @else
                                <span class="badge bg-warning">Waiting</span>
                            @endif
                        </td>
                        <td>
                            @if (!$checkout->is_paid)
                                <form action="{{ route('admin.update.paid', $checkout) }}" method="POST">
                                    @csrf
                                    @method('patch')

                                    <button class="btn btn-sm btn-primary">Set to Paid</button>
                                </form>    
                            @endif
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