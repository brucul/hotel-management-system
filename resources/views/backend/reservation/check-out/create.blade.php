@extends('backend.main')
@section('content')
<section class="content-header">
	<h1>
		{{$apk_name}}
		<small>{{$hotel_name}}</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">{{ $title }}</a></li>
		<li class="active">{{ $sub_title }}</li>
	</ol>
	<hr/>
</section>

<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Check Out</h3>
		</div>
		<form class="form-horizontal" role="form" action="{{ route('checkout.store', $reservation->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="box-body ">
				<div class="row">
					<div class="col-xs-3">
						<label>Invoice</label>
						<input type="text" class="form-control" name="invoice" readonly value="{{ $reservation->payment->invoice }}">
						<hr/>
						<label>Deskripsi Kamar:</label>
						<div class="small">
							<p>Tipe Kamar <span class="pull-right">{{ $reservation->room->category->name }}</span></p>
							<p>Harga <span class="pull-right">@currency($reservation->room->price)</span></p>
							<input type="hidden" name="room_id" value="{{ $reservation->room->id }}">
						</div>
					</div>
					<div class="col-xs-4">
						<label>Nama Tamu</label>
						<input type="text" class="form-control" name="guest_id" value="{{ $reservation->guest->name }}" readonly>
						<hr/>
						<div class="row">
							<div class="col-xs-6">
								<label>Tanggal Check In</label>
								<input type="text" class="form-control" name="check_in" value="{{ $reservation->check_in }}" readonly>
							</div>
							<div class="col-xs-6">
								<label>Tanggal Check Out</label>
								<input type="text" class="form-control" name="check_out" value="{{ date('Y-m-d') }}" readonly>
							</div>
						</div><br/>
						<label>Tambahan Kasur</label>
						<input type="text" class="form-control" name="bed" value="{{ $reservation->bed }}" readonly>
						<br/>
						<label>Diskon Kamar</label>
						<input type="text" class="form-control" name="discount" value="{{ $reservation->discount->value }}%" readonly>
					</div>
					<div class="col-xs-5">
						<div class="row">
							<div class="col-xs-6">
								<label>Dewasa</label>
								<input type="text" class="form-control" placeholder="Jumlah Orang Dewasa" name="adult" value="{{ $reservation->adult }}" readonly>
							</div>
							<div class="col-xs-6">
								<label>Anak-anak</label>
								<input type="text" class="form-control" placeholder="Jumlah Anak-anak" name="child" value="{{ $reservation->children }}" readonly>
							</div>
						</div><br/>
						<label>Tipe Reservasi</label>
						<input type="text" class="form-control" name="" value="{{ $reservation->category->name }}" readonly>
						<br/>
						<label>Nama Instansi</label>
						<input type="text" class="form-control" name="" value="{{ $reservation->agency }}" readonly>
						<br/>
						<label>Metode Pembayaran</label>
						<input type="text" class="form-control" readonly name="payment" value="{{ $reservation->payment->method }}">
						<br/>
						<label>Keterangan</label>
						<textarea name="additional_info" class="form-control" placeholder="Informasi Tambahan" readonly>{{ $reservation->additional_info }}</textarea>
						<br/>
					</div>
				</div><hr/>
				<h3 class="box-title">Rincian Tagihan</h3>
				<div class="row">
					<div class="col-xs-12">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Keterangan Layanan / Produk</th>
									<th>Harga</th>
									<th>Qty</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Nomor Kamar : {{ $reservation->room->number }} - Tipe Kamar : {{ $reservation->room->category->name }}</td>
									<td>@currency($reservation->room->price)</td>
									<td>{{ $qty }} Malam</td>
									<td>@currency($qty*$reservation->room->price)</td>
								</tr>
								<tr>
									<td>Tambahan Kasur</td>
									<td>@currency($bed)</td>
									<td>{{ $reservation->bed }} Buah</td>
									<td>@currency($bed*$reservation->bed)</td>
								</tr>
								{{--<tr>
									<td colspan="4"><b>Room Acomodation</b></td>
								</tr>
								<tr>
									<td>Breakfast</td>
									<td>@currency($breakfast)</td>
									<td>{{ ($reservation->adult) }} (Adult) + {{ $reservation->children }} (Children 50%)</td>
									<td>@currency($breakfast_price * $qty)</td>
								</tr>--}}
								<tr>
									<td rowspan="4"></td>
									<td colspan="2"><b>Sub-Total</b></td>
									<td>@currency(($qty*$reservation->room->price) + ($bed*$reservation->bed))</td>
								</tr>
								<tr>
									<td>Diskon Kamar</td>
									<td>{{ $reservation->discount->value }}%</td>
									<td>@currency($discount*$qty)</td>
								</tr>
								<tr>
									<td colspan="2"><b>Grand Total</b></td>
									<td>@currency((($reservation->room->price-$discount)*$qty)+($bed*$reservation->bed))</td>
									<input type="hidden" name="payment_total" value="{{ (($reservation->room->price-$discount)*$qty) + ($bed*$reservation->bed)}}">
									{{--<input type="hidden" name="payment_total" value="{{ (($reservation->room->price-$discount)*$qty) + ($bed*$reservation->bed) - ($breakfast_price * $qty) }}">--}}
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-success pull-right">Check Out</button>
				<a href="{{ route('billing', $reservation->id) }}" class="btn btn-primary" target="_blank" style="text-decoration: none;"> Cetak Billing  </a>
			</div>
			<!-- /.box-footer -->
		</form>
	</div>
</section>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    $('.select2-1').select2()

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
  })
</script>
@endsection
