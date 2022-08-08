@extends('layout.app')

@section('title', 'My Dashboard')

@section('content')
<section class="dashboard my-5">
    <div class="container">
        <div class="row text-left">
            <div class=" col-lg-12 col-12 header-wrap mt-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2 >
                            List Discount
                        </h2>
                    </div>

                    <div>
                        <a href="{{ route('admin.discount.create') }}" class="btn btn-sm btn-primary">Add Discount</a>
                    </div>                       
                </div>
            </div>
        </div>
        <div class="row my-5">
            @include('components.alert')
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Percentage (%)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($discounts as $discount)
                        <tr>
                            <td>{{ $discount->name }}</td>
                            <td>{{ $discount->code }}</td>
                            <td>{{ $discount->description }}</td>
                            <td>{{ $discount->percentage }}</td>
                            <td>
                                <a href="{{ route('admin.discount.edit', $discount) }}" class="btn btn-success btn-sm">Edit</a>
                                <a href="{{ route('admin.discount.destroy', $discount) }}" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('delete-form').submit()">Delete</a>
                                
                                <form action="{{ route('admin.discount.destroy', $discount) }}" class="d-none" id="delete-form" method="POST">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Data Has Empty</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection