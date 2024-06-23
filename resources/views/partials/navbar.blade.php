<ul>
    <li>
        <a href="#" class="nav-logo"><img src="{{ URL::asset('/images/welcome_page/Saunders Logo.png') }}"
                alt="Saunders Co." height="40"></a>
    </li>
    <div class="nav-center">
        <li><a href="{{ route('dashboard') }}">Beranda</a></li>
        <li><a href="#">Berita</a></li>
        <li><a href="#">Inspirasi</a></li>
        <li><a href="#">Finansial</a></li>
        <li><a href="#">Survei</a></li>
        <li><a href="#">WFH</a></li>
        <li><a href="#">Info IT</a></li>
    </div>
    <li>
        @if (Route::has('login'))
            @auth
                <div class="dropdown">
                    <a class="nav-login">{{ Auth::user()->name }}</a>
                    <div class="dropdown-content">
                        <a href={{ route('employee') }} class="list first">Profile</a>
                        <a href={{ route('logout') }} class="list last"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            id="logout">Log Out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>

                <script src="{{ URL::asset('/javascript/navbar/dropdownNav.js') }}"></script>
            @else
                <a href="{{ route('login') }}" class="nav-login">Login</a>
            @endauth
        @endif
    </li>
</ul>
