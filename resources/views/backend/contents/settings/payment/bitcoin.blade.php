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
                            <div class="form-group">    
                                <label for="btc_address">Bitcoin Address</label>
                                <input type="text" class="form-control" name="btc_address" id="btc_address" value="{{ json_decode($payment['payment_setting'][0]['value'])->btc_address }}">
                            </div>
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