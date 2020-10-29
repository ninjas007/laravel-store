<ul class="list-group mb-3 z-depth-1" style="font-size: 12px !important;">
	<li class="list-group-item d-flex justify-content-between lh-condensed">
		<div class="my-0">Ongkir</div>
		<span class="text-muted">Rp. {{ format_uang($cost) }}</span>
	</li>
	<li class="list-group-item d-flex justify-content-between lh-condensed">
		<div class="my-0">{{ $courier }}</div>
		<span class="text-muted">{{ $service }}</span>
	</li>
	<li class="list-group-item d-flex justify-content-between lh-condensed">
		<div class="my-0">Pengiriman ke </div>
		<span class="text-muted">{{ $city_destination }}</span>
	</li>
</ul>
<ul class="list-group mb-3 z-depth-1" id="totalAll">
	<li class="list-group-item d-flex justify-content-between">
		<span>Total</span>
		<strong>Rp. {{ format_uang($total_akhir) }}</strong>
	</li>
</ul>
