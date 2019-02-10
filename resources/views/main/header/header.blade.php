<ul id="login_dropdown" class="dropdown-content">
    <li><a href="{{ route('login') }}">Login</a></li>
    <li><a href="{{ route('register') }}">Register</a></li>
</ul>
<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo">DiveLogRepeat</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="#">Calculator</a></li>
            <li><a href="#">Dive Log</a></li>
            <li><a href="">Blog</a></li>
            <li><a class="dropdown-trigger" href="#!" data-target="login_dropdown">Login<i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
    </div>
</nav>