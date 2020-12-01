<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Invoice Order - {{ $code_order }}</title>
	<style>
		body {
			margin-top: -30px;
			font-size: 14px;
		}
		.invoice {
			text-align: center;
			margin-bottom: 20px;
		}
		.half {
			width: 50%;
		}
		.table {
			width: 100%;
		}
		.text-right {
			text-align: right;
		}
		#tproduk tr th,
		#tproduk tr td{
			text-align: left;
			border: 1px solid #cccc;
			padding: 8px;
		}
		#total {
			margin-top: 10px;
		}
		#total tr td {
			text-align: right;
			padding: 8px;
		}
	</style>
</head>
<body>
	<h1 class="invoice">INVOICE</h1>
	<table class="table" style="margin-bottom: 20px;">
		<tr>
			<td class="half">
				<table class="table">
					<tr><td style="font-weight: bold">Tagihan Kepada:</td></tr>
					<tr><td>Nama&nbsp;:&nbsp;{{ $orderDetail['name'] }}</td></tr>
					<tr><td>Alamat&nbsp;:&nbsp;{{ $orderDetail['address'] }}</td></tr>
				</table>
			</td>
			<td class="half">
				<table class="text-right table">
					<tr><td>&nbsp;</td></tr>
					<tr><td>Tanggal&nbsp;:</td><td>{{ $orderDetail['created_at'] }}</td></tr>
					<tr><td>No Order&nbsp;:</td><td>{{ $code_order }}</td></tr>
				</table>
			</td>
		</tr>
	</table>
	<hr>
	<table class="table" id="tproduk" cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th width="200">Nama Produk</th>
				<th width="30" class="center">Qty</th>
				<th class="center">Berat</th>
				<th style="text-align: right;">Harga</th>
				<th style="text-align: right;">Total</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($orderDetail['orders'] as $item)
				<tr>
					<td>{{ $item->name }}</td>
					<td style="text-align: center">{{ $item->qty }}</td>
					<td style="text-align: center">{{ $item->weight }}</td>
					<td style="text-align: right; width: 120px;">{{ format_uang($item->price) }}</td>
					<td style="text-align: right; width: 150px;">{{ format_uang($item->total) }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<table class="table" id="total" cellspacing="0" cellpadding="0">
		<tr>
			<td class="half">
				Di isi payment disini
				Jika ingin mengubah metode pembayaran silahkan contact admin di 34343434
			</td>
			<td class="half" style="padding: 0">
				<table class="table" style="text-align: right;" cellpadding="0" cellspacing="0">
					<tr>
						<td>Subtotal</td>
						<td>{{ format_uang($orderDetail['order_total']['total_all']) }}</td>
					</tr>
					<tr>
						<td>Ongkir</td>
						<td>{{ format_uang($orderDetail['order_total']['ongkir']) }}</td>
					</tr>
					<tr>
						<td>Total Berat</td>
						<td>{{ $orderDetail['total_weight'] }}</td>
					</tr>
					<tr>
						<td>Total</td>
						<td>{{ format_uang($orderDetail['total_last']) }}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>