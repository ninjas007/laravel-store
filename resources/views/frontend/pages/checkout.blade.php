@extends('frontend.template')
@section('content')
<div class="container dark-grey-text mt-5">
	<!--Grid row-->
	<div class="row" id="content">
		<!--Grid column-->
		<div class="col-md-8 mb-4">
			<!--Card-->
			<div class="card">
				<!--Card content-->
				<form class="card-body">
					<div class="md-form mb-5">
						<input type="text" id="name" class="form-control" placeholder="John Doe">
						<label for="name" class="">Name</label>
					</div>
					<div class="md-form mb-5">
						<input type="text" id="email" class="form-control" placeholder="johndoe@mail.com">
						<label for="email" class="">Email</label>
					</div>
					<div class="md-form mb-5">
						<input type="text" id="phone" class="form-control" placeholder="081xxxxxxx">
						<label for="phone" class="">Phone</label>
					</div>
					<div class="md-form mb-5">
						<input type="text" id="address" class="form-control" placeholder="1234 Main St">
						<label for="address" class="">Address</label>
					</div>
					<div class="row">
						<!--Grid column-->
						<div class="col-lg-12 col-md-12 mb-4">
							<label for="country">Country</label>
							<select class="custom-select d-block w-100" id="country" required>
								<option value="" disabled selected>Choose...</option>
								@foreach ($countries as $country)
									<option value="{{ $country }}">{{ $country }}</option>
								@endforeach
								<option>United States</option>
							</select>
						</div>
						<!--Grid column-->
						<!--Grid column-->
						<div class="col-lg-6 col-md-6 mb-4">
							<label for="state">State</label>
							<select class="custom-select d-block w-100" id="state" required>
								<option value="">Choose...</option>
							</select>
						</div>
						<!--Grid column-->
						<!--Grid column-->
						<div class="col-lg-6 col-md-6 mb-4">
							<label for="postal_code">Postal Code</label>
							<input type="text" class="form-control" id="postal_code" placeholder="65213" required>
						</div>
						<!--Grid column-->
					</div>
					<!--Grid row-->
					<hr>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="same-address">
						<label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
					</div>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="save-info">
						<label class="custom-control-label" for="save-info">Save this information for next time</label>
					</div>
					<hr>
					<div class="d-block my-3">
						<div class="custom-control custom-radio">
							<input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
							<label class="custom-control-label" for="credit">Credit card</label>
						</div>
						<div class="custom-control custom-radio">
							<input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
							<label class="custom-control-label" for="debit">Debit card</label>
						</div>
						<div class="custom-control custom-radio">
							<input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
							<label class="custom-control-label" for="paypal">Paypal</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="cc-name">Name on card</label>
							<input type="text" class="form-control" id="cc-name" placeholder="" required>
							<small class="text-muted">Full name as displayed on card</small>
							<div class="invalid-feedback">
								Name on card is required
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="cc-number">Credit card number</label>
							<input type="text" class="form-control" id="cc-number" placeholder="" required>
							<div class="invalid-feedback">
								Credit card number is required
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3 mb-3">
							<label for="cc-expiration">Expiration</label>
							<input type="text" class="form-control" id="cc-expiration" placeholder="" required>
							<div class="invalid-feedback">
								Expiration date required
							</div>
						</div>
						<div class="col-md-3 mb-3">
							<label for="cc-expiration">CVV</label>
							<input type="text" class="form-control" id="cc-cvv" placeholder="" required>
							<div class="invalid-feedback">
								Security code required
							</div>
						</div>
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
			<span class="text-muted">Your cart</span>
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
</script>
@endsection