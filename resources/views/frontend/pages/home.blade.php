@extends('frontend.template')

@section('banner')
<!--Carousel Wrapper-->
  <div id="carousel-1z" class="carousel slide carousel-fade pt-4" data-ride="carousel">

    <!--Indicators-->
    <ol class="carousel-indicators">
      @for ($i = 0; $i < count($banners); $i++)
        <li data-target="#carousel-1z" data-slide-to="{{ $i }}" class="{{ ($i == 0) ? 'active' : '' }}"></li>
      @endfor
    </ol>
    <!--/.Indicators-->

    <!--Slides-->
    <div class="carousel-inner" role="listbox">
      
      @foreach ($banners as $key => $banner)
        
        @if ($banner->is_button == 1)
            <div class="carousel-item {{ ($key == 0) ? 'active' : '' }}">
              <div class="view" style="background-image: url('{{ $banner->image }}'); background-repeat: no-repeat; background-size: cover;">

                <!-- Mask & flexbox options-->
                <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

                  <div class="text-center white-text mx-5 wow fadeIn">
                    <h1 class="mb-4">
                      <strong>{{ $banner->title }}</strong>
                    </h1>

                    <p class="mb-4 d-none d-md-block">
                      <strong>{{ $banner->subtitle }}</strong>
                    </p>

                    <a target="_blank" href="https://mdbootstrap.com/education/bootstrap/" class="btn btn-outline-white btn-lg">{{ $banner->text_button }}</a>
                  </div>

                </div>
              </div>
            </div>    
        @endif
      
      @endforeach

    </div>
    <!--/.Slides-->

    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-1z" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-1z" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->

  </div>
  <!--/.Carousel Wrapper-->
@endsection

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
              <a href="{{ url('product/'. $product->slug ) }}">
              <img src="{{ $product->path_image }}" class="card-img-top"
                alt="">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>
            <!--Card image-->

            <!--Card content-->
            <div class="card-body text-center">
              <!--Category & Title-->
              <a href="{{ url('category/'. $product->slug ) }}" class="grey-text">
                <h5>{{ $product->categories['name'] }}</h5>
              </a>
              <h5>
                <strong>
                  <a href="{{ url('product/'. $product->slug ) }}" class="dark-grey-text">{{ $product->name }}</a>
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
    {{ $products->links() }}\
  </nav>
  <!--Pagination-->

</div>
@endsection