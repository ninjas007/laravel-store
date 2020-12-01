@extends('frontend.template')
@section('content')
<div class="container my-5">
	<div class="row py-5">
		<div class="col-12 text-center mb-3">
			<p>Pesanan Anda berhasil diproses! <br>Silahkan cek email anda untuk melihat detail orderan anda.
				<br>Terima kasih telah berbelanja dengan kami secara online!
			</p>
		</div>
		<div class="col-12 text-center">
            <a href="/invoice/{{ $code_order }}" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Cetak Invoice</a>
            <a href="/" class="btn btn-info btn-sm"><i class="fa fa-home"></i> Belanja Lagi</a>
		</div>
	</div>
</div>
@endsection