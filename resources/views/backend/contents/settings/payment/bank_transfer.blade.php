@extends('backend.template')
@section('content')
<div class="app-main__inner">
    <div class="form">
        <form action="{{ url('admin/payments/update', [$payment['id']]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-cash icon-gradient bg-happy-itmeo"></i>
                        </div>
                        <div>Payments</div>
                    </div>
                    <div class="page-title-actions">
                        <button type="submit" data-toggle="tooltip" title="Save" data-placement="bottom" class="btn-shadow mr-3 btn btn-primary font-weight-bold">Save
                        </button>
                        <div class="d-inline-block">
                            <a href="{{ url('admin/payments') }}" class="btn btn-danger font-weight-bold btn-shadow"><i class="fa fa-reply"></i> Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="metismenu-icon pe-7s-menu"></i> Setting</h5>
                            <button type="button" data-toggle="tooltip" title="Add Bank" data-placement="bottom" class="btn-shadow mb-3 btn btn-primary font-weight-bold" id="addBank">Add</button>
                            @foreach ($payment['payment_setting'] as $value)
                            <div class="py-2 row">
                                <div class="col-3">
                                    <input type="text" class="form-control" name="name[]" placeholder="Bank name" value="{{ $value['name'] }}">
                                </div>
                                <div class="col-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="value[]" value="{{ $value['value'] }}" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-danger remove" type="button"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="list-bank"></div>

                            <div class="form-group py-2">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="0" {{ $payment['status'] == 0 ? 'selected' : '' }}>Disabled</option>
                                    <option value="1" {{ $payment['status'] == 1 ? 'selected' : '' }}>Enabled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/Javascript">
$(document).ready(function() {
$('#addBank').click(function(){
$('.list-bank').after(`<div class="py-2 row">
    <div class="col-3">
        <input type="text" class="form-control" name="name[]" placeholder="Bank name">
    </div>
    <div class="col-9">
        <div class="input-group">
            <input type="text" class="form-control" name="value[]" value="" required>
            <div class="input-group-append">
                <button class="btn btn-danger remove" type="button" id="button-addon2"><i class="fa fa-times"></i></button>
            </div>
        </div>
    </div>
</div>`);
remove()
});
function remove() {
$('.remove').click(function(){
$(this).parent().parent().parent().parent().remove()
});
}
remove()

});
</script>
@endsection