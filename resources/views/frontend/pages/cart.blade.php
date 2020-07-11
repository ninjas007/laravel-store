@extends('frontend.template')
@section('content')
<div class="container dark-grey-text mt-5">
    <div class="row" id="content">
          {{-- Content  --}}
    </div>
</div>
@endsection
@section('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/Javascript">
    // carts
    getCart();

    function getCart() {
        $.ajax({
            url: '/api/cart',
            dataType: 'json',
            success: function(response) {
                if(response.count > 0) {
                    let data = ``
                    $.each(response.carts, function(index, item){
                        data += `
                        <tr>
                            <td><a class="input-group-text btn-danger btn-sm text-white remove" onclick="remove('${item.rowId}')"><i class="fas fa-times"></i></a></td>
                            <td>
                                <img src="${item.options['image']}" alt="${item.name}" class="img-fluid mr-2" width="40">
                                ${item.name}
                            </td>
                            <td class="float-right">
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control form-control-sm qty" value="${item.qty}">
                                    <div class="input-group-append">
                                        <a class="input-group-text btn-info text-white update" data-rowid="${item.rowId}"><i class="fas fa-sync"></i></a>
                                    </div>
                                </div>
                            </td>
                            <td class="text-right">${item.price}</td>
                            <td class="text-right">${item.price * item.qty}</td>
                        </tr>
                        `});

                    content = `
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
                                    ${data}                                    
                                    <tr>
                                        <td colspan="4" align="right" class="font-weight-bold" style="font-size: 1rem;">Subtotal</td>
                                        <td class="text-right">${response.subtotal}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" align="right"><a href="/checkout" class="btn btn-primary btn-sm font-weight-bold">Checkout</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>`
                } else {
                    content = `<div class="col-12 text-center">
                        <p>Your cart is empty!</p>
                        <a href="/" class="btn btn-info">Continue</a>
                    </div>`
                }

                $('#content').html(content)
                $('#count').html(response.count)
            }
        })
        .then(function(){
            $('.update').click(function(){
                qty = $(this).closest('tr').find('.qty').val();
                rowid = $(this).data('rowid');
                update(qty, rowid)
            })
        });
    }

    // remove item
    function remove(rowid) {
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
                url: '/api/cart/remove',
                dataType: 'json',
                data: {rowid: rowid},
                success: function(response) {
                    swal('Success', response.message, 'success')
                    .then(()=>{
                        getCart()
                    })
                }
            })
          }
        });
    }

    $('.update').click(function(){
        qty = $(this).closest('tr').find('.qty').val();
        rowid = $(this).data('rowid');
        update(qty, rowid)
    })

    // update item
    function update(qty, rowid) {
        $.ajax({
            url: '/api/cart/update',
            dataType: 'json',
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {rowid: rowid, qty: qty},
            success: function(response) {
                swal('Success', response.message, 'success')
                .then(()=>{
                    getCart()
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
    }
</script>
@endsection