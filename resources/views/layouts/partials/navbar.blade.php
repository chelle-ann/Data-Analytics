 <!-- Navbar Brand-->
 <a class="navbar-brand ps-3" href=#!>
                 <img src="{{ asset('image/carlogo.png') }}" alt="Pawtect Logo" style="height: 40px; vertical-align: middle;">
            </a>   
 
 <!-- Navbar -->
 <nav class="navbar sticky-top navbar-expand-lg bg-pink">
        <div class="container-fluid">
            <a class="navbar-brand bold-link" href="#">DA4B_GROUP4</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">MEMBERS</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Michelle Ann Alberto</a></li>
                            <li><a class="dropdown-item" href="#">Cherry Mae Sanchez</a></li>
                            <li><a class="dropdown-item" href="#">Gwen Timbal</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        this.closest('form').submit();"
                                >
                                        {{ __('Log Out') }}
                                </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>