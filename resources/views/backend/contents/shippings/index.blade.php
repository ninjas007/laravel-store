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
                            @foreach ($shippings as $shipping)
                                <tr>
                                    <td>{{ $shipping->name }}</td>
                                    <td>{{ $shipping->status == 1 ? 'Enabled' : 'Disabled' }}</td>
                                    <td class="text-center"><a href="{{ url('admin/shippings/edit/'.$shipping->id) }}" class="btn btn-sm btn-info"><i class="pe-7s-note font-weight-bold"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection