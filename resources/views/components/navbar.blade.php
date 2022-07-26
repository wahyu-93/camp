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
                    <a class="nav-link" href="#">Pricing</a>
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
                            <svg class="svg-icon user-photo" viewBox="0 0 20 20">
                                <path d="M12.075,10.812c1.358-0.853,2.242-2.507,2.242-4.037c0-2.181-1.795-4.618-4.198-4.618S5.921,4.594,5.921,6.775c0,1.53,0.884,3.185,2.242,4.037c-3.222,0.865-5.6,3.807-5.6,7.298c0,0.23,0.189,0.42,0.42,0.42h14.273c0.23,0,0.42-0.189,0.42-0.42C17.676,14.619,15.297,11.677,12.075,10.812 M6.761,6.775c0-2.162,1.773-3.778,3.358-3.778s3.359,1.616,3.359,3.778c0,2.162-1.774,3.778-3.359,3.778S6.761,8.937,6.761,6.775 M3.415,17.69c0.218-3.51,3.142-6.297,6.704-6.297c3.562,0,6.486,2.787,6.705,6.297H3.415z"></path>
                            </svg>
                        @endif

                        <ul class="dropdown-menu mt-1" style="right: 0; left: auto;" aria-labelledby="dropdownMenuLink">
                            <li>
                                <a href="" class="dropdown-item text-end">My Dashboard</a>
                            </li>

                            <li>
                                <a href="" class="dropdown-item text-end">My Profile</a>
                            </li>

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