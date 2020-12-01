<div class="border my-3 py-3 text-center">Total Tagihan Rp 100.000</div>
@if ($payment_method_id == 1)
	<div class="text-muted text-center mt-3 mb-3">Silahkan transfer ke salah satu rekening berikut</div>
	<ul class="list-group text-center" style="list-style: none; font-size: 14px">
		@foreach ($payments as $payment)
			<li class="list-group-item">
				<img src="{{ asset('payments').'/'.$payment['image'] }}" class="img-fluid rounded-circle" alt="{{ $payment['name'] }}" width="40"> 
				<span class="pl-1">{{ $payment['value'] }}</span>
			</li>
		@endforeach
	</ul>
@elseif ($payment_method_id == 2)
	<div class="text-muted text-center mt-4 mb-3">Silahkan transfer ke salah satu rekening berikut</div>
	<ul class="list-group" style="list-style: none; font-size: 14px">
		@foreach ($payments as $payment)
			<li class="list-group-item border-0">
				<img src="{{ asset('payments').'/'.$payment['image'] }}" class="img-fluid rounded-circle" alt="{{ $payment['name'] }}" width="40"> 
				<span class="pl-1">{{ $payment['value'] }}</span>
			</li>
		@endforeach
	</ul>
@elseif ($payment_method_id == 3)
	<div class="text-muted text-center mt-4 mb-3">Silahkan transfer ke BTC address berikut</div>
	<ul class="list-group" style="list-style: none; font-size: 14px">
		@foreach ($payments as $payment)
			<li class="list-group-item text-center">
				<img src="{{ asset('payments').'/'.$payment['image'] }}" class="img-fluid rounded-circle" alt="{{ $payment['name'] }}" width="40"> 
				<span class="pl-1">{{ json_decode($payment['value'])->btc_address }}</span>
			</li>
		@endforeach
	</ul>
@endif