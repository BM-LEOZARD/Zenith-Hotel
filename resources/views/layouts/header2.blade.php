<header class="header_area">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand logo_h" href="#"><img src="{{ asset('website/asset/logo.png') }}"
                    alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                <ul class="nav navbar-nav menu_nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ '/' }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ '/fasilitas' }}">Fasilitas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ '/wedding' }}">Wedding</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ '/gallery' }}">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ '/contact' }}">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ '/reservasi' }}">Reservasi</a></li>
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @else
                        @auth
                            @if (Auth::user()->role == 'Admin')
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                            @elseif (Auth::user()->role == 'Customer')
                                <li class="nav-item"><a class="nav-link" href="{{ route('customer.dashboard') }}">Dashboard</a>
                                </li>
                            @endif
                        @endauth
                    @endguest
                </ul>
            </div>
        </nav>
    </div>
</header>
