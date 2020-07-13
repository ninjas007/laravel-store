@extends('backend.template')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-truck icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div>Shippings</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title"><i class="metismenu-icon pe-7s-menu"></i> Shipping List</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th width="30">Setting</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
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