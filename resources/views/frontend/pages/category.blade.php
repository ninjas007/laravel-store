@extends('frontend.template')

@section('banner')
<div id="carousel-1z" class="carousel slide carousel-fade pt-4" data-ride="carousel">    
    <ol class="carousel-indicators">
        
        @for ($i = 0; $i < count($banners); $i++)
        <li data-target="#carousel-1z" data-slide-to="{{ $i }}" class="{{ ($i == 0) ? 'active' : '' }}"></li>
        @endfor

    </ol>
    <div class="carousel-inner" role="listbox">

        @foreach ($banners as $key => $banner)
        @if ($banner->is_button == 1)
        <div class="carousel-item {{ ($key == 0) ? 'active' : '' }}">
            <div class="view" style="background-image: url('{{ $banner->image }}'); background-repeat: no-repeat; background-size: cover;">
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
    <a class="carousel-control-prev" href="#carousel-1z" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-1z" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
@endsection

@section('content')
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 mb-5">
        <span class="navbar-brand">Categories:</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
        aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="basicExampleNav">
            <ul class="navbar-nav mr-auto">
                
                @foreach ($categories as $cat)
                <li class="nav-item {{ ($cat->id == $category->id) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('category/'.$cat->slug) }}">{{ $cat->name }}
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                @endforeach

            </ul>
            <form class="form-inline">
                <div class="md-form my-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                </div>
            </form>
        </div>
    </nav>
    <section class="text-center mb-4">
        <div class="row wow fadeIn">
            
            @foreach ($products as $product)
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card">
                    <span class="bg-success text-white p-2" style="position: absolute; right: -0.5rem; top:-0.5rem; z-index: 1">New</span>
                    <div class="view overlay">
                        <a href="{{ url('product/'. $product->slug ) }}">
                            <img src="{{ $product->path_image }}" class="card-img-top"
                            alt="">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>
                    <div class="card-body text-center">
                        
                        <h5 class="text-muted"><a href="{{ url('product/'. $product->slug ) }}" class="dark-grey-text">{{ $product->name }}</a></h5>
                        <p class="font-weight-bold font-weight-bold text-primary">Rp. {{ $product->price }}</p>
                        
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </section>
    <nav class="d-flex justify-content-center wow fadeIn">
        {{ $products->links() }}
    </nav>
</div>
@endsection