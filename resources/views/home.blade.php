@extends('layout.app')

@section('title', 'Laracamp')

@section('content')
    <section class="banner">
        @include('partials._banner')
    </section>

    <section class="benefits">
        @include('partials._benefit')
    </section>

    <section class="steps">
        @include('partials._step')
    </section>

    <section class="pricing">
        @include('partials._pricing')
    </section>

    <section class="testimonials">
        @include('partials._testimonial')
    </section>
@endsection