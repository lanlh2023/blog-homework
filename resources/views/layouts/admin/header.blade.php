<nav class="navbar navbar-expand-lg navbar-light bg-light px-2 header d-flex justify-content-between">
    <a class="navbar-brand" href="#">Blog</a>
    <div class="collapse d-flex flex-nowrap" id="navbarNavAltMarkup">
        <div class="navbar-nav d-flex flex-nowrap flex-row">
            @if (!Auth::check())
                <a class="nav-item nav-link " href="/">Home </a>
            @else
                <a class="nav-item nav-link " href="#">{{ Auth::user()->name }} </a>
                <a class="nav-item nav-link" href="/logout">Logout</a>
            @endif
        </div>
    </div>
</nav>
