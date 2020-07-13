@extends('backend.template')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-home icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Not Found</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block">
                    <a href="{{ url('admin/dashboard') }}" class="btn btn-danger font-weight-bold btn-shadow"><i class="fa fa-reply"></i> Cancel</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-lg-12">
            <div class="card p-5">
                NOT FOUND
            </div>
        </div>
    </div>
</div>
@endsection