@extends('layout.app')

@section('title', 'Laracamp')

@section('content')
    <div class="row my-5">
      
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="card">
                    <div class="card-header">Update Discount <strong>{{ $discount->name }}</strong></div>
                    
                    <div class="card-body">
                        <form action="{{ route('admin.discount.update', $discount) }}" method="POST">
                            @csrf
                            @method('patch')

                            <div class="form-group mb-4">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $discount->name }}">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="code">Code</label>
                                <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') ?? $discount->code }}">

                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="descripton">Descripton</label>
                                <textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror" style="resize: none">{{ old('description') ?? $discount->description }}</textarea>
                                
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>  

                            <div class="form-group mb-4">
                                <label for="percentage">Discount Percentage (%)</label>
                                <input type="number" name="percentage" id="percentage" class="form-control @error('percentage') is-invalid @enderror" value="{{ old('percentage') ?? $discount->percentage }}" min="1" max="100">
                                
                                @error('percentage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="submit" value="submit" class="btn btn-sm btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection