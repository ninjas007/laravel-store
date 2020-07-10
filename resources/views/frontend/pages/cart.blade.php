@extends('frontend.template')
@section('content')
<div class="container dark-grey-text mt-5">
    <div class="row">        
        @if (count($carts) <= 0)
        <div class="col-12 text-center">
            <p>Your cart is empty!</p>
            <a href="/" class="btn btn-info">Continue</a>
        </div>
        @else
        <div class="col-12">
            <table class="table table-bordered table-striped" style="overflow-x: scroll;">
                <thead>
                    <tr>
                        <th width="10">#</th>
                        <th>Product</th>
                        <th class="text-right" width="150">Quantity</th>
                        <th class="text-right" width="200">Unit Price</th>
                        <th class="text-right" width="200">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $product)
                    <tr>
                        <td><a class="input-group-text btn-danger btn-sm text-white remove" data-rowid="{{ $product->rowId }}"><i class="fas fa-times"></i></a></td>
                        <td>
                            <img src="{{ $product->options['image'] }}" alt="{{ $product->name }}" class="img-fluid mr-2" width="40">
                            {{ $product->name }}
                        </td>
                        <td class="float-right">
                            <div class="input-group mb-3">
                                <input type="number" class="form-control form-control-sm qty" value="{{ $product->qty }}">
                                <div class="input-group-append">
                                    <a class="input-group-text btn-info text-white update" data-rowid="{{ $product->rowId }}"><i class="fas fa-sync"></i></a>
                                </div>
                            </div>
                        </td>
                        <td class="text-right">{{ $product->price }}</td>
                        <td class="text-right">{{ $product->price * $product->qty }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" align="right" class="font-weight-bold" style="font-size: 1rem;">Subtotal</td>
                        <td class="text-right">{{ Cart::subtotal() }}</td>
                    </tr>
                    <tr>
                        <td colspan="5" align="right"><button type="submit" class="btn btn-primary btn-sm font-weight-bold">Checkout</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endif       
    </div>
</div>
@endsection
@section('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/Javascript">
    // remove item
    $('.remove').click(function(){
        swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this item!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
                url: 'cart/remove',
                dataType: 'json',
                data: {rowid: $(this).data('rowid')},
                success: function(response) {
                    swal('Success', response.message, 'success')
                    .then(()=>{
                        location.reload();
                    })
                }
            })
          }
        });
    });

    // update item
    $('.update').click(function(){
        rowid = $(this).data('rowid');
        qty = $(this).closest('tr').find('.qty').val();

        $.ajax({
            url: 'cart/update',
            dataType: 'json',
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {rowid: rowid, qty: qty,  },
            success: function(response) {
                swal('Success', response.message, 'success')
                .then(()=>{
                    $('#count').html(response.count)
                })
            }
        })
    });
</script>
@endsection