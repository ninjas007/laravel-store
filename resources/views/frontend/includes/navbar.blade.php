<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
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

      <!-- Left -->
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link waves-effect" href="{{ url('home') }}">Home
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link waves-effect" href="#">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link waves-effect" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link waves-effect" href="#">Checkout</a>
        </li>
      </ul>

      <!-- Right -->
      <ul class="navbar-nav nav-flex-icons">
        <li class="nav-item">
          <a class="nav-link waves-effect">
            <span class="badge red z-depth-1 mr-1"> 1 </span>
            <i class="fas fa-shopping-cart"></i>
            <span class="clearfix d-none d-sm-inline-block"> Cart </span>
          </a>
        </li>
        <li class="nav-item">
          <a href="https://www.facebook.com/mdbootstrap" class="nav-link waves-effect" target="_blank">
            <i class="fab fa-facebook-f"></i>
          </a>
        </li>
        <li class="nav-item">
          <a href="https://twitter.com/MDBootstrap" class="nav-link waves-effect" target="_blank">
            <i class="fab fa-twitter"></i>
          </a>
        </li>
        <li class="nav-item">
          <a href="https://github.com/mdbootstrap/bootstrap-material-design" class="nav-link border border-light rounded waves-effect"
            target="_blank">
            <i class="fab fa-github mr-2"></i>MDB GitHub
          </a>
        </li>
      </ul>

    </div>

  </div>
</nav>
<!-- Navbar -->