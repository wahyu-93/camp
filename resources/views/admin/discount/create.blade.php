@extends('layout.app')

@section('title', 'Laracamp')

@section('content')
    <div class="row my-5">
      
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="card">
                    <div class="card-header">Insert a new discount</div>
                    
                    <div class="card-body">
                        <form action="{{ route('admin.discount.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="code">Code</label>
                                <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}">

                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="descripton">Descripton</label>
                                <textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror" style="resize: none">{{ old('description') }}</textarea>
                                
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>  

                            <div class="form-group mb-4">
                                <label for="percentage">Discount Percentage (%)</label>
                                <input type="number" name="percentage" id="percentage" class="form-control @error('percentage') is-invalid @enderror" value="{{ old('percentage') }}" min="1" max="100">
                                
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