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
                                <input type="text" class="form-control" name="name" id="name" value="{{ $shipping['name'] }}" required>
                            </div>
                            <div class="form-group">
                                <label for="api_key">Api Key</label>
                                <input type="text" class="form-control" name="api_key" id="api_key" value="{{ json_decode($shipping['setting'])->api_key }}" required>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label for="account">Tipe Akun</label>
                                    <small class="text-primary">* Sesuaikan tipe akun  <a class="text-dark" href="https://rajaongkir.com/dokumentasi" target="_blank">Rajaongkir</a> anda</small>
                                    <select name="account" id="account" class="form-control" required>
                                        <option value="starter" {{ json_decode($shipping['setting'])->account == 'starter' ? 'selected' : '' }} >Starter</option>
                                        <option value="basic" {{ json_decode($shipping['setting'])->account == 'basic' ? 'selected' : '' }}>Basic</option>
                                        <option value="pro" {{ json_decode($shipping['setting'])->account == 'pro' ? 'selected' : '' }}>Pro</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="city_id">Kota Pengirim</label>
                                    <select name="city_id" id="city_id" class="form-control" required>
                                        <option selected disabled>Choose..</option>
                                        @foreach ($cities as $city)
                                        <option value="{{ $city->id }}" {{ $city->id == $shipping['origin_city_id'] ? 'selected' : '' }}>{{ $city->city_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea name="note" id="note" class="form-control">{{ $shipping['note'] }}</textarea>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <div class="col">
                                    <div class="h6">Courier</div>
                                    <small class="text-primary">* Pastikan courier yang diinput terdaftar di <a class="text-dark" href="https://rajaongkir.com/dokumentasi" target="_blank">Rajaongkir</a></small>
                                </div>
                                <div class="col">
                                    <button type="button" class="h6 btn btn-primary font-weight-bold float-right" id="addKurir">Add</button>
                                </div>
                            </div>
                            @foreach ($shipping['shipping_setting'] as $courier)
                            <div class="form-group">                                
                                <div class="input-group">
                                    <input type="text" class="form-control" name="courier[]" value="{{ strtoupper($courier['value']) }}" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-danger remove" type="button"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div id="after"></div>
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
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/Javascript">
$(document).ready(function(){
    $('#addKurir').click(function(){
        $('#after').after(`<div class="form-group">                                
                                <div class="input-group">
                                    <input type="text" name="courier[]" class="form-control" value="" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-danger remove" type="button"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>`)
        remove()
    })

    function remove() {
        $('.remove').click(function(){
            if($('.remove').length > 1) {
                $(this).parent().parent().parent().remove()
            }
        }) 
    }

    remove()
})
</script>
@endsection