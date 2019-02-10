{{-- Main Nav Dropdowns --}}

<ul id="login_dropdown" class="dropdown-content">
    <li><a href="{{ route('login') }}">Login</a></li>
    <li><a href="{{ route('register') }}">Register</a></li>
</ul>

<ul id="logout_dropdown" class="dropdown-content text-blue">
    <li><a href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            Log Out
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
    <li><a href="#">Settings</a></li>
</ul>

{{-- Main Nav Skeleton --}}
<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo">DiveLogRepeat</a>
        <a href="#" data-target="mobile_nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="#">Calculator</a></li>
            <li><a href="#">Dive Log</a></li>
            <li><a href="">Blog</a></li>
            @if (Auth::check())
                <li><a class="dropdown-trigger" href="#!" data-target="logout_dropdown">Welcome {{ auth()->user()->first_name }}<i class="material-icons right">arrow_drop_down</i></a></li>
            @else
                <li><a class="dropdown-trigger" href="#!" data-target="login_dropdown">Login<i class="material-icons right">arrow_drop_down</i></a></li>
            @endif
        </ul>
    </div>
</nav>

{{-- Mobile Nav --}}
<ul class="sidenav" id="mobile_nav">
    <li><a href="#">Calculator</a></li>
    <li><a href="#">Dive Log</a></li>
    <li><a href="">Blog</a></li>
    @if (Auth::check())
        <ul class="collapsible" data-collapsible="accordian">
            <li>
                <div class="collapsible-header black-text">Welcome {{ auth()->user()->first_name }}</div>
                <div class="collapsible-body side_nav_collapse">
                    <ul>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Log Out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        <li><a href="#">Settings</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    @else
        <ul class="collapsible" data-collapsible="accordian">
            <li>
                <div class="collapsible-header black-text">Log In / Register</div>
                <div class="collapsible-body side_nav_collapse">
                    <ul>
                        <li><a href="{{ route('login') }}">Log In</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    @endif
</ul>