<nav class="navbar navbar-expand-lg navbar-light py-5 mb-10 container d-flex justify-content-xl-between justify-content-lg-between justify-content-md-center justify-content-sm-center">
  <a class="navbar-brand col-md-1 col-sm-10 text-center pl-0" href="{{ route('home') }}">
    <img src="{{ asset('images/logo/logomark.min.svg')}}" alt="">
    <img src="{{ asset('images/logo/logotype.min.svg') }}" alt="">
    </a>
  <div class="navbar d-flex justify-content-between align-items-center justify-content-md-between justify-content-sm-between justify-content-xl-between">
    <ul class="ml-lg-auto flex-1 nav flex-nowrap ml-lg-auto d-flex justify-content-end align-items-center h-100">
      <li class="nav-item active">
        <a class="nav-link-custom text-dark" href="{{ route('home') }}">HOME <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link-custom text-dark" href="/releases">RELEASES</a>
      </li>
      <li class="nav-item">
        <a class="nav-link-custom text-dark" href="/envoyer">ENVOYER</a>
      </li>
      <li class="nav-item">
        <a class="nav-link-custom text-dark" href="/forge">FORGE</a>
      </li>
      <li class="nav-item">
        <a class="nav-link-custom text-dark" href="/vapor">VAPOR</a>
      </li>
    </ul>
  </div>
</nav>
