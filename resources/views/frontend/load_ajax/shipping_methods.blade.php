<div class="modal fade" id="shippingModal" tabindex="-1" role="dialog" aria-labelledby="shippingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shippingModalLabel">Pengiriman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkboxPengiriman">
                        <label class="form-check-label" for="checkboxPengiriman">Alamat Pengiriman sama dengan alamat invoice</label>
                    </div>
                </div>
                <div class="form-group destination">
                    <label for="addressShipping">Alamat</label>
                    <input type="text" id="addressShipping" class="form-control" required>
                </div>
                <div class="form-group destination">
                    <label for="provinceShipping">Provinsi</label>
                    <select class="custom-select d-block w-100" id="provinceShipping" required>
                        <option value="" selected disabled>Pilih...</option>
                        @foreach ($provinces as $province)
                        <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group destination">
                            <label for="cityShipping">Kota</label>
                            <select class="custom-select d-block w-100" id="cityShipping" required>
                                <option value="" selected disabled>Pilih...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group destination">
                            <label for="posShipping">Kode Pos</label>
                            <input type="text" class="form-control" id="posShipping" required>
                        </div>
                    </div>
                </div>
                <div class="form-group metode-pengiriman">
                    <label for="metodePengiriman">Metode Pengiriman</label>
                    <select class="custom-select d-block w-100" id="metodePengiriman" required>
                        @foreach ($shippings as $shipping)
                        <option value="{{ $shipping['id'] }}">{{ $shipping['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group text-center metode-pengiriman" id="contentShippingMethod">
                    @foreach ($shippings as $shipping)
                        @if ($shipping['id'] == 1)
                            @foreach ($shippings[0]['shipping_setting'] as $value)
                            <div class="form-check form-check-inline setting id-{{ $shipping['id'] }}">
                                <input class="form-check-input courier"  type="radio" name="inlineRadioOptions" id="{{ $value['value'] }}" value="{{ $value['value'] }}" onclick="courierCost(`{{ $value['value'] }}`)">
                                <label class="form-check-label" for="{{ $value['value'] }}">{{ $value['name'] }}</label>
                            </div>
                            @endforeach
                        @else
                            <div class="input-group mb-2 setting id-{{ $shipping['id'] }}" style="display: none;">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-hand-holding-usd"></i></div>
                                </div>
                                <input type="text" class="form-control" id="{{ $shipping['code'] }}" disabled value="Biaya Rp. {{ format_uang(json_decode($shipping['setting'])->cost) }}">
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="mt-3 form-group text-center" id="courierCost"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" id="setShipping">Set</button>
            </div>
        </div>
    </div>
</div>