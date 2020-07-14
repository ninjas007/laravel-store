@extends('frontend.template')
@section('content')
<div class="container dark-grey-text mt-5">
	<div class="row" id="content">
		<div class="col-md-8 mb-4">
			<div class="card">
				<form class="card-body">
					<div class="row">
						<div class="col">
							<div class="md-form">
								<input type="text" id="name" class="form-control" placeholder="John Doe">
								<label for="name">Nama</label>
							</div>
						</div>
						<div class="col">
							<div class="md-form">
								<input type="text" id="email" class="form-control" placeholder="johndoe@mail.com">
								<label for="email">Email</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="md-form">
								<input type="text" id="phone" class="form-control" placeholder="081xxxxxxx">
								<label for="phone">No Handphone</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="md-form">
								<input type="text" id="address" class="form-control" placeholder="1234 Main St">
								<label for="address">Alamat</label>
							</div>
						</div>
					</div>
					<div class="row mb-5">
						<div class="col">
							<label for="state">Provinsi</label>
							<select class="custom-select d-block w-100" id="state" required>
								<option value="">Choose...</option>
							</select>
						</div>
					</div>
					<div class="row mb-5">
						<div class="col-6">
							<label for="city">Kota</label>
							<select class="custom-select d-block w-100" id="city" required>
								<option value="">Choose...</option>
							</select>
						</div>
						<div class="col-6">
							<label for="postal_code">Postal Code</label>
							<input type="text" class="form-control" id="postal_code" placeholder="65213" required>
						</div>
					</div>
					<hr>
					<p class="h5 py-2 text-success">Pengiriman</p>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="same-address">
						<label class="custom-control-label" for="same-address">Alamat pengiriman sama dengan alamat penagihan saya</label>
					</div>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="save-info">
						<label class="custom-control-label" for="save-info">Save this information for next time</label>
					</div>
					<hr>
					<div class="d-block my-3">
						<p class="h5 py-2 text-success">Pembayaran</p>
						@foreach ($payments as $payment)
							<div class="custom-control custom-radio my-2">
								<input id="{{ $payment['code'] }}" name="paymentMethod" type="radio" class="custom-control-input checkbox" required value="{{ $payment['id'] }}">
								<label class="custom-control-label" for="{{ $payment['code'] }}">
									{{ $payment['name'] }}
								</label>
							</div>
							@if ($payment['id'] == 1)
								<select name="list_bank" class="form-control my-2" id="listBank" disabled style="display: none">
									@foreach ($payment['payment_setting'] as $value)
										<option value="{{ $value['value'] }}">{{ $value['value'] }}</option>
									@endforeach
								</select>
							@endif
						@endforeach
					</div>
					<hr class="mb-4">
					<button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
				</form>
			</div>
			<!--/.Card-->
		</div>
		<!--Grid column-->
		<!--Grid column-->
		<div class="col-md-4 mb-4">
			<!-- Heading -->
			<h4 class="d-flex justify-content-between align-items-center mb-3">
			<span class="text-muted"><a href="{{ url('cart') }}">Cart</a></span>
			<span class="badge badge-success badge-pill">{{ Cart::count() }}</span>
			</h4>
			<!-- Cart -->
			<ul class="list-group mb-3 z-depth-1">
				@foreach ($items as $item)
					<li class="list-group-item d-flex justify-content-between lh-condensed">
						<h6 class="my-0">{{ $item->name }} x {{ $item->qty }}</h6>
						<span class="text-muted">{{ $item->price * $item->qty }}</span>
					</li>
				@endforeach
				<li class="list-group-item d-flex justify-content-between bg-light">
					<div class="text-success">
						<h6 class="my-0">Promo code</h6>
						<small>EXAMPLECODE</small>
					</div>
					<span class="text-success">-$5</span>
				</li>
				<li class="list-group-item d-flex justify-content-between">
					<span>Total (IDR)</span>
					<strong>{{ Cart::total() }}</strong>
				</li>
			</ul>
			<!-- Cart -->
			<!-- Promo code -->
			<form class="card p-2">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Promo code" aria-label="Recipient's username" aria-describedby="basic-addon2">
					<div class="input-group-append">
						<button class="btn btn-primary btn-md waves-effect m-0" type="button">Redeem</button>
					</div>
				</div>
			</form>
			<!-- Promo code -->
		</div>
		<!--Grid column-->
	</div>
	<!--Grid row-->
</div>
@endsection
@section('scripts')
<script type="text/Javascript">
	$('#country').change(function(){
		$.ajax({
			url: '/api/region/states',
			dataType: 'json',
			data: {state: $(this).val()},
			success: function(response) {
				let option = ``;
				$.each(response.states, (key, item)=>{
					option += `<option>${item}</option>`
				})
				$('#state').html(option)
			}
		})
	})

	$('.checkbox').click(function(){
		if($(this).val() == 1) {
			$('#listBank').css('display', 'block')
			$('#listBank').removeAttr('disabled')
		} else {
			$('#listBank').css('display', 'none')
			$('#listBank').attr('disabled', true)
		}
	})
</script>
@endsection