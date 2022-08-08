<!doctype html>
<html lang="en">

<head>
    @include('partials._header')

    <title>@yield('title')</title>
</head>

<body>

    @include('components.navbar')
    {{-- @include('layouts.navigation') --}}
    
    @include('components.alert')

    @yield('content')

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    @stack('after-script')

</body>

</html>