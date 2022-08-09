@extends('layout.app')

@section('title', 'Login')

@section('content')

<section class="login-user">
    <div class="left">
        <img src="{{ asset('assets/images/ill_login_new.png') }}" alt="">
    </div>
    <div class="right">
        <img src="{{ asset('assets/images/logo.png') }}" class="logo" alt="">
        <h1 class="header-third">
            Start Today
        </h1>
        <p class="subheader">
            Because tomorrow become never
        </p>
        @include('components.alert')
        <form action="{{ route('login.user') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror">

                @error('email')
                    <span class="text-danger text-small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">

                @error('password')
                    <span class="text-danger text-small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <input type="submit" value="Login" class="btn btn-sm btn-primary form-control">
                
                <a class="btn btn-border btn-google-login form-control mt-1" href="{{ route('login.google') }}">
                    <img src="{{ asset('assets/images/ic_google.svg') }}" class="icon" alt=""> Sign In with Google
                </a>
            </div>
        </form>
        
    </div>
</section>

@endsection