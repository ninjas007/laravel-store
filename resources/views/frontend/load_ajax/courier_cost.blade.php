@if ($costs['results'][0]['costs'])
<table class="table">
		<tr>
			<th>Layanan</th>
			<th>Biaya</th>
			<th>Estimasi Hari</th>
		</tr>
		@foreach ($costs['results'][0]['costs'] as $key => $cost)
			<tr>
				<td>
					<div class="form-check">
					  <input class="form-check-input service" type="checkbox" name="service" id="{{ $cost['service'] }}" value="{{ $cost['service'] }}">
					  <label class="form-check-label" for="{{ $cost['service'] }}">
						{{ $cost['service'] }}    
					  </label>
					</div>
				</td>
				<td>Rp. {{ format_uang($cost['cost'][0]['value']) }}</td>
				<td>{{ $cost['cost'][0]['etd'] }}</td>
			</tr>
		@endforeach
</table>
<small class="text-muted font-italic">Pengiriman dari {{ $costs['origin_details']['city_name'] }} ke {{ $costs['destination_details']['city_name'] }}</small>
@else
<p class="text-center">Kurir Tidak Mendukung</p>
@endif