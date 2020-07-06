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