
<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar py-3">
  <div class="container">

    <!-- Brand -->
    <a class="navbar-brand waves-effect" href="{{ url('/') }}">
      <strong class="blue-text">STORE</strong>
    </a>

    <!-- Collapse -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Links -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Right -->
      <ul class="navbar-nav nav-flex-icons ml-auto">
        <li class="nav-item {{ (Request::segment(1) == 'product') ? 'active' : ''}}">
          <a class="nav-link waves-effect" href="#">Products</a>
        </li>
        <li class="nav-item {{ (Request::segment(1) == 'contact') ? 'active' : ''}}">
          <a class="nav-link waves-effect" href="#">Contact</a>
        </li>
        <li class="nav-item {{ (Request::segment(1) == 'account') ? 'active' : ''}}">
          <a class="nav-link waves-effect" href="#">Account</a>
        </li>
        <li class="nav-item {{ (Request::segment(1) == 'checkout') ? 'active' : ''}}">
          <a class="nav-link waves-effect" href="{{ url('checkout') }}">Checkout</a>
        </li>
        <li class="nav-item {{ (Request::segment(1) == 'cart') ? 'active' : ''}}">
          <a href="{{ url('cart') }}" class="nav-link waves-effect">
            <span class="clearfix d-none d-sm-inline-block"> Cart </span>
            <i class="fas fa-shopping-cart"></i>
            <span class="badge green z-depth-1 rounded-circle border-0" id="count" style="position: absolute; top: 0.1rem; right: 0.1rem">{{ Cart::count() }}</span>
          </a>
        </li>
      </ul>

    </div>

  </div>
</nav>