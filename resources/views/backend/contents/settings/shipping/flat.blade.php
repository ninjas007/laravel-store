@extends('backend.template')
@section('content')
<div class="app-main__inner">
    <div class="form">
        <form action="{{ url('admin/shippings/update', [$shipping['id']]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-truck icon-gradient bg-happy-itmeo"></i>
                        </div>
                        <div>Shippings</div>
                    </div>
                    <div class="page-title-actions">
                        <button type="submit" data-toggle="tooltip" title="Save" data-placement="bottom" class="btn-shadow mr-3 btn btn-primary font-weight-bold">Save
                        </button>
                        <div class="d-inline-block">
                            <a href="{{ url('admin/shippings') }}" class="btn btn-danger font-weight-bold btn-shadow"><i class="fa fa-reply"></i> Cancel</a>
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
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $shipping['name'] }}" required max="20">
                            </div>
                            <div class="form-group">
                                <label for="cost">Biaya</label>
                                <input type="text" class="form-control" name="cost" id="cost" value="{{ json_decode($shipping['setting'])->cost }}" required>
                            </div>
                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea name="note" id="note" class="form-control">{{ $shipping['note'] }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="0" {{ $shipping['status'] == 0 ? 'selected' : '' }}>Disabled</option>
                                    <option value="1" {{ $shipping['status'] == 1 ? 'selected' : '' }}>Enabled</option>
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