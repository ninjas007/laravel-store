@extends('backend.template')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div>Products</div>
            </div>
            <div class="page-title-actions">
                <button type="button" data-toggle="tooltip" title="Delete" data-placement="bottom" class="btn-shadow mr-3 btn btn-danger" id="bulkDelete">
                <i class="fa fa-trash"></i>
                </button>
                <div class="d-inline-block">
                    <a href="{{ url('admin/products/add') }}" class="btn btn-info font-weight-bold btn-shadow" data-toggle="tooltip" title="Add Product" data-placement="bottom"><i class="fa fa-plus"></i> Add</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  {{ session()->get('error') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title"><i class="metismenu-icon pe-7s-menu"></i> Product List</h5>
                    <table class="mb-0 table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th width="10"><input type="checkbox" class="checkbox-th"></th>
                                <th class="text-center">Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th class="text-center" width="80">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($products) <= 0)
                                <tr>
                                    <td colspan="6" class="text-center">No result</td>
                                </tr>
                            @endif
                            @foreach ($products as $product)
                                <tr>
                                    <td><input type="checkbox" class="checkbox-td" value="{{ $product->id }}"></td>
                                    <td class="text-center"><img src="{{ $product->path_image }}" width="50"></td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('admin/products/edit/'. $product->id) }}" class="btn btn-primary btn-sm" title="Edit"><i class="pe-7s-note font-weight-bold"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title"><i class="metismenu-icon pe-7s-search"></i> Filter</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/Javascript">
    $('.checkbox-th').click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $('#bulkDelete').click(function(){
        let id = [];
        $('.checkbox-td:checked').each(function(){
            id.push($(this).val())
        });
        if(id.length > 0) {
            swal({
              title: "Are you sure?",
              text: "Are you sure want to delete this data ?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.ajax({
                    url: '/admin/products/delete',
                    data: {id: id},
                    success: function(response){
                        swal("Success", response, "success")
                        .then(function(){
                            location.reload();
                        });
                    },
                    error: function(error){
                        swal("Error", error.responseJSON, "error")
                        .then(function(){
                            location.reload();
                        });
                    }
                });
              }
            })
        } else {
            swal("Info", "Please select atleast one checkbox", "info")
        }
    });
</script>
@endsection