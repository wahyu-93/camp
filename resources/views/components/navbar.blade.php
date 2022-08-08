<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/images/logo.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Program</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Mentor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pricing">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Business</a>
                </li>
            </ul>
            
            @auth
                <div class="d-flex user-logged nav-item dropdown no-arrow">
                    <a href="#" data-bs-toggle="dropdown" id="dropdownMenuLink" aria-expanded="false">
                        Halo, {{ auth()->user()->name }} !
                        @if(auth()->user()->avatar)
                            <img src="{{ url(auth()->user()->avatar) }}" class="user-photo" alt="nopict">
                        @else
                            <img src="{{ url('https://ui-avatars.com/api/?name=' . auth()->user()->name) }}"  class="user-photo" alt="nopict">
                        @endif

                        <ul class="dropdown-menu mt-1" style="right: 0; left: auto;" aria-labelledby="dropdownMenuLink">
                            <li>
                                <a href="{{ route('dashboard') }}" class="dropdown-item text-end">My Dashboard</a>
                            </li>

                            <li>
                                <a href="" class="dropdown-item text-end">My Profile</a>
                            </li>

                            @if(auth()->user()->is_admin)
                                <li>
                                    <a href="{{ route('admin.discount.index') }}" class="dropdown-item text-end">Discount</a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ route('logout') }}" class="dropdown-item text-end" onclick="event.preventDefault(); getElementById('form-delete').submit();">Logout</a>

                                <form action="{{ route('logout') }}" id="form-delete" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </a>
                </div>
            @endauth

            @guest    
                <div class="d-flex">
                    <a href="{{ route('login') }}" class="btn btn-master btn-secondary me-3">
                        Sign In
                    </a>
                    <a href="#" class="btn btn-master btn-primary">
                        Sign Up
                    </a>
                </div>
            @endguest
    
        </div>
    </div>
</nav>