@extends('frontend.template')

@section('content')
<div class="container">

  <!--Navbar-->
  <nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 mb-5">

    <!-- Navbar brand -->
    <span class="navbar-brand">Categories:</span>

    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
      aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="basicExampleNav">

      <!-- Links -->
      <ul class="navbar-nav mr-auto">
        
        @foreach ($categories as $key => $category)
          <li class="nav-item {{ ($key == 0) ? 'active' : ''}}">
            <a class="nav-link" href="#">{{ $category->name }}
              @if ($key == 0)
                <span class="sr-only">(current)</span>
              @endif
            </a>
          </li>
        @endforeach

      </ul>
      <!-- Links -->

      <form class="form-inline">
        <div class="md-form my-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        </div>
      </form>
    </div>
    <!-- Collapsible content -->

  </nav>
  <!--/.Navbar-->

  <!--Section: Products v.3-->
  <section class="text-center mb-4">

    <!--Grid row-->
    <div class="row wow fadeIn">
    
      @foreach ($products as $product)
        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card image-->
            <div class="view overlay">
              <img src="{{ $product->image }}" class="card-img-top"
                alt="">
              <a>
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>
            <!--Card image-->

            <!--Card content-->
            <div class="card-body text-center">
              <!--Category & Title-->
              <a href="" class="grey-text">
                <h5>{{ $product->categories['name'] }}</h5>
              </a>
              <h5>
                <strong>
                  <a href="" class="dark-grey-text">{{ $product->name }}
                    <span class="badge badge-pill danger-color">NEW</span>
                  </a>
                </strong>
              </h5>

              <h4 class="font-weight-bold blue-text">
                <strong>{{ $product->price }}$</strong>
              </h4>

            </div>
            <!--Card content-->

          </div>
          <!--Card-->

        </div>
        <!--Grid column-->
      @endforeach

    </div>
    <!--Grid row-->

  </section>
  <!--Section: Products v.3-->

  <!--Pagination-->
  <nav class="d-flex justify-content-center wow fadeIn">
    {{ $products->links() }}
    {{-- <ul class="pagination pg-blue">

      <!--Arrow left-->
      <li class="page-item disabled">
        <a class="page-link" href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </a>
      </li>

      <li class="page-item active">
        <a class="page-link" href="#">1
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="page-item">
        <a class="page-link" href="#">2</a>
      </li>
      <li class="page-item">
        <a class="page-link" href="#">3</a>
      </li>
      <li class="page-item">
        <a class="page-link" href="#">4</a>
      </li>
      <li class="page-item">
        <a class="page-link" href="#">5</a>
      </li>

      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </a>
      </li>
    </ul> --}}
  </nav>
  <!--Pagination-->

</div>
@endsection