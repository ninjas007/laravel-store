@extends('frontend.template')
@section('content')
<div class="container dark-grey-text mt-5">
    <div class="row wow fadeIn justify-content-center">
        <div class="col-md-5 mb-4">
            <img src="{{ $product->path_image }}" class="img-fluid" alt="{{ $product->name }}">
        </div>
        <div class="col-md-6 mb-4">
            <div class="p-4">
                <div class="mb-3">
                    @foreach ($product->categories as $category)
                    @if ($category->name != 'All')
                    <a href="{{ url('category/'. $category->slug ) }}">
                        <span class="badge purple mr-1">{{ $category->name }}</span>
                    </a>
                    @endif
                    @endforeach
                </div>
                <p class="lead">
                    <span class="mr-1">
                        <del>Rp. 500</del>
                    </span>
                    <span>Rp. {{ $product->price }}</span>
                </p>
                <p class="lead font-weight-bold">Short Description</p>
                <p>{!! substr(strip_tags($product->description), 0, 300) !!}</p>
                <form class="d-flex justify-content-left">
                    <input type="hidden" name="product_id" id="productId" value="{{ $product->id }}">
                    <input type="number" name="qty" value="1" id="qty" class="form-control" style="width: 100px">
                    <button class="btn btn-primary btn-md my-0 p" id="addToCart" type="button">Add to cart
                    <i class="fas fa-shopping-cart ml-1"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <div class="row d-flex justify-content-center wow fadeIn">
        <div class="col-md-6 text-center">
            <h4 class="my-4 h4">Additional information</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus suscipit modi sapiente illo soluta odit
                voluptates,
            quibusdam officia. Neque quibusdam quas a quis porro? Molestias illo neque eum in laborum.</p>
        </div>
    </div>
    <div class="row wow fadeIn">
        <div class="col-lg-4 col-md-12 mb-4">
            <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/11.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/12.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/13.jpg" class="img-fluid" alt="">
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/Javascript">
    $('#addToCart').click(function(){
        product_id = $('#productId').val();
        qty = $('#qty').val();

        $.ajax({
            url: '/api/cart/store',
            dataType: 'json',
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {product_id: product_id, qty: qty,  },
            success: function(response) {
                swal('Success', response.message, 'success').then(()=>{
                    $('#count').html(response.count)
                    $('#qty').val('1')
                })
            },
            error: function(error) {
                data = error.responseJSON;
                m = data.message;
                if(Array.isArray(data.message)){
                    m = ``;
                    span = document.createElement("span");
                    $.each(data.message, function(key, item){
                        $.each(item, function(i, val){
                            m += val;
                        })
                    })
                    span.innerHTML = m
                    swal({title: 'Error', content: span, icon: 'error'}).then(()=>{
                        $('#count').html(data.count)
                    })
                } else {
                    swal('Error', m, 'error').then(()=>{
                        $('#count').html(data.count)
                    })
                }
            }
        })
    });
</script>
@endsection