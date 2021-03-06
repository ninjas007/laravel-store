@extends('frontend.template')
@section('content')
<div class="container dark-grey-text mt-5">
	<div class="row" id="content">
		<div class="col-md-7 mb-4">
			<div class="card">
				<div class="card-body">
					<p class="h5 py-2 text-success">Informasi Customer</p>
					<div class="row">
						<div class="col">
							<div class="md-form my-3">
								<input type="text" id="name" class="form-control" placeholder="John Doe">
								<label for="name">Nama</label>
							</div>
						</div>
						<div class="col">
							<div class="md-form my-3">
								<input type="text" id="email" class="form-control" placeholder="johndoe@mail.com">
								<label for="email">Email</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="md-form my-3">
								<input type="text" id="phone" class="form-control" placeholder="081xxxxxxx">
								<label for="phone">No Handphone</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="md-form my-3">
								<input type="text" id="addressPayment" class="form-control" placeholder="1234 Main St">
								<label for="addressPayment">Alamat</label>
							</div>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col">
							<label for="provincePayment">Provinsi</label>
							<select class="custom-select d-block w-100" id="provincePayment" required>
								<option value="" selected disabled>Choose...</option>
								@foreach ($provinces as $province)
								<option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-6">
							<label for="cityPayment">Kota</label>
							<select class="custom-select d-block w-100" id="cityPayment" required>
								<option value="">Choose...</option>
							</select>
						</div>
						<div class="col-6">
							<label for="posPayment">Postal Code</label>
							<input type="text" class="form-control" id="posPayment" placeholder="65213" required>
						</div>
					</div>
					<hr>
					<div class="row mb-3">
						<div class="col-12">
							<p class="h5 py-2 text-success">Pengiriman</p>
							<button type="button" class="btn btn-primary btn-sm font-weight-bold mx-0 mb-3" id="btnShippingModal">Set Pengiriman</button>
							<div class="alamat-pengiriman"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-5 mb-4" style="font-size: 12px !important;">
			<h5 class="d-flex justify-content-between align-items-center mb-3 font-weight-bold">
			<span class="text-success">Detail Tagihan</span>
			</h5>
			<ul class="list-group mb-3 z-depth-1">
				@php
				$total = 0;
				@endphp
				@foreach ($items as $item)
				@php
				$total += $item->price * $item->qty
				@endphp
				<li class="list-group-item d-flex justify-content-between lh-condensed">
					<div class="my-0">{{ $item->name }} x {{ $item->qty }}</div>
					<span class="text-muted">Rp. {{ format_uang($item->price * $item->qty) }}</span>
				</li>
				@endforeach
			</ul>
			<div id="totalAll">
				<ul class="list-group mb-3 z-depth-1">
					<li class="list-group-item d-flex justify-content-between">
						<span>Total</span>
						<strong>Rp. {{ format_uang($total) }}</strong>
					</li>
				</ul>
			</div>
			<button class="btn btn-success font-weight-bold btn-block" data-toggle="modal" data-target="#modalPayment">Bayar Sekarang</button>
		</div>
	</div>
</div>

<!-- The Modal -->
<div class="modal fade" id="modalPayment">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h5 class="modal-title">Pembayaran</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="list-group">
					@foreach ($payments as $payment)
							<div class="form-check form-check-inline list-group-item list-group-item-action {{ str_replace(' ', '', $payment['name']) }}">
							    <input class="form-check-input paymentMethod" type="radio" name="inlineRadioOptions" id="{{ $payment['code'] }}" onclick="valPaymentMethod(`{{ $payment['id'] }}`)">
							    <label class="form-check-label label-payment-method" for="{{ $payment['code'] }}">{{ $payment['name'] }}</label>
							</div>
					@endforeach
				</div>
				<div id="contentPayment"></div>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-success btn-sm form-control" id="selesaikanPembayaran">Selesaikan Pembayaran</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<style>
	.label-payment-method:hover {
		cursor: pointer;
	}
</style>
<script type="text/Javascript">
	
	var paymentMethod = null;

	// show modal shipping
	$('#btnShippingModal').click(function(){
		$.ajax({
			url: '/api/shippingMethods',
			dataType: 'html',
			beforeSend: function() {
				$('#btnShippingModal').text('Loading...')
			},
			success: function(response) {
				$('#btnShippingModal').text('Set Pengiriman')
				$('#content').parent().after(response)
				$('#shippingModal').modal('show')
				$('.metode-pengiriman').hide()

				cityDestination()
				checkBoxPengiriman()
				setShipping()
				
				$('#metodePengiriman').change(function(){
					$('.setting').hide()
					
					if($(this).val() == 1) {
						$('.id-1').fadeIn()
					} else {
						$('#courierCost').html('')
						$(`.id-${$(this).val()}`).fadeIn()
					}
				})
			}
		})
	});

	// load data provinsi untuk alamat customer
	$('#provincePayment').change(function(){
		$.ajax({
			url: '/api/region/cities',
			dataType: 'json',
			data: {province_id: $(this).val()},
			beforeSend: function(){
				$('#cityPayment').html('<option>Loading...</option>')
			},
			success: function(response) {
				let option = ``;
				$.each(response.cities, (key, item)=>{
					option += `<option value="${item.id}">${item.city_name}</option>`
				})
				$('#cityPayment').html(option)
			}
		})
	});

	// active button payment
	$('.form-check-label').click(function(){
		$('.list-group-item-action').removeClass('active');
		$(`.${$(this).html().replace(' ', '')}`).addClass('active');
	});


	// selesaikan pembayaran orderan
	$('#selesaikanPembayaran').click(function(){
		if (paymentMethod != null) {
			$.ajax({
				url: '/api/checkoutOrder',
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				dataType: 'json',
				method: 'post',
				data: {
					payment_method_id: paymentMethod
				},
				beforeSend: function() {
					$('#preloader').fadeIn();
				},
				success: function(response) {
					$('#preloader').fadeOut();
					$(location).attr('href', `checkout-success/${response.code_order}`);
				}
			});
		}
	});

	// ambil keterangan transfer dari payment method
	function valPaymentMethod(payment_method_id) {
		paymentMethod = payment_method_id;
		$.ajax({
			url: '/api/getPayments',
			dataType: 'html',
			data: {
				payment_method_id: payment_method_id
			},
			beforeSend: function() {
				$('#contentPayment').html('<div class="text-center my-3">Loading...</div>')
			},
			success: function(response) {
				$('#contentPayment').html(response)
			}
		})
	}

	// checkbox alamat pengiriman sama dengan alamat customer
	function checkBoxPengiriman() {
		$('#checkboxPengiriman').click(function(){
			if($('#cityPayment').val() == ""){
				alert('Pilih kota customer terlebih')
				return $(this).prop('checked', false)
			}
			if($(this).prop('checked')){
				$('.destination').css('display', 'none')
				$('.metode-pengiriman').show()
				$.ajax({
					url: '/api/region/cities',
					dataType: 'json',
					data: {province_id: $('#provincePayment').val()},
					beforeSend: function(){
						$('#cityShipping').html('<option>Loading...</option>')
					},
					success: function(response) {
						let option = ``;
						$.each(response.cities, (key, item)=>{
							option += `<option value="${item.id}">${item.city_name}</option>`
						})
						$('#cityShipping').html(option)
						$('.metode-pengiriman').show()
					}
				})
			} else {
				$('.destination').css('display', 'block')
				$('#courierCost').html('')
			}
		})
	}

	// load data kota untuk pengiriman
	function cityDestination() {
		$('#provinceShipping').change(function(){
			$.ajax({
				url: '/api/region/cities',
				dataType: 'json',
				data: {province_id: $(this).val()},
				beforeSend: function(){
					$('#cityShipping').html('<option>Loading...</option>')
				},
				success: function(response) {
					let option = ``;
					$.each(response.cities, (key, item)=>{
						option += `<option value="${item.id}">${item.city_name}</option>`
					})
					$('#cityShipping').html(option)
					$('.metode-pengiriman').show()
				}
			})
		})
	}

	// load ongkir per kurir
	function courierCost(courier = '') {
		$.ajax({
			url: '/api/courierCost',
			dataType: 'html',
			data: {courier: courier, city_destination_id: $('#cityShipping').val()},
			beforeSend: function() {
				$('#preloader').fadeIn()
			},
			success: function(response) {
				$('#preloader').fadeOut()
				$('#courierCost').html(response)
				// service click
				$('.service').click(function(){
					$('.service').prop('checked', false);
					$(this).prop('checked', true);
				});
			}
		})
	}

	// set pengiriman
	function setShipping() {
		$('#setShipping').click(function(){
			city_destination_id = $('#cityShipping').val();
			shipping_method_id = $('#metodePengiriman').val();
			alamat = $('#addressShipping').val();
			service = '';
			courier = '';

			// service
			$(".service:checked").each(function(){
                service = ($(this).val());
            });

            $(".courier:checked").each(function(){
                courier = ($(this).val());
            });

			// kalau alamaat pengiriman dan alamat member sama
			if ($('input#checkboxPengiriman').is(':checked')) {
				city_destination_id = $('#cityPayment').val();
				alamat = $('#addressPayment').val()
			}

			if (shipping_method_id == 1) {
				data = {
					city_destination_id: city_destination_id,
					shipping_method_id: shipping_method_id,
					courier: courier,
					service: service,
					alamat: alamat
				}
			} else if (shipping_method_id == 2) {

			} else if (shipping_method_id == 3) {

			} else {
				return swal('Periksa kembali metode pembayaran');
			}

			$.ajax({
				url: '/api/setShippingMethod',
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				dataType: 'json',
				data: data,
				method: 'POST',
				beforeSend: function() {
					$('#preloader').fadeIn()
				},
				success: function(response) {
					$('#preloader').fadeOut();
					total = `
						<ul class="list-group mb-3 z-depth-1" style="font-size: 12px !important;">
							<li class="list-group-item d-flex justify-content-between lh-condensed">
								<div class="my-0">Ongkir</div>
								<span class="text-muted">Rp. ${response.cost}</span>
							</li>
							<li class="list-group-item d-flex justify-content-between lh-condensed">
								<div class="my-0">${response.courier}</div>
								<span class="text-muted">${response.service}</span>
							</li>
							<li class="list-group-item d-flex justify-content-between lh-condensed">
								<div class="my-0">Pengiriman ke </div>
								<span class="text-muted">${response.city_destination}</span>
							</li>
							<li class="list-group-item d-flex justify-content-between lh-condensed">
								<div class="my-0">Berat </div>
								<span class="text-muted">${response.weight} gram</span>
							</li>
						</ul>
						<ul class="list-group mb-3 z-depth-1" id="totalAll">
							<li class="list-group-item d-flex justify-content-between">
								<span>Total</span>
								<strong>Rp. ${response.total_akhir}</strong>
							</li>
						</ul>
					`;
					$('#totalAll').html(total);
					$('.alamat-pengiriman').html(response.alamat_pengiriman);
					$('#shippingModal').modal('hide');
				},
				error: function(err) {
					alert('Terjadi masalah, refresh browser atau hubungi admin');
				}
			})
		});
	}
</script>
@endsection