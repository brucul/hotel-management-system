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
			<h3 class="box-title">Check In</h3>
		</div>
		<form class="form-horizontal" role="form" action="{{ route('checkin.store') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="box-body ">
				<input type="hidden" name="room_id" value="{{$numb}}" id="room_id">
				<div class="row">
					<div class="col-xs-3">
						<label>Invoice</label>
						<input type="text" class="form-control" name="invoice" readonly value="INV-{{date('Ymd')}}-{{$numb}}-" id="invoice">
						{{--<input type="hidden" class="form-control" name="payment_total" value="{{ $type_room->price-($type_room->discount->value/100*$type_room->price) }}">--}}
						<hr/>
						<label>Deskripsi Kamar:</label>
						<div class="small">
							<p>Tipe Kamar <span class="pull-right">{{ $type_room->category->name }}</span></p>
							<p>Harga <span class="pull-right">@currency($type_room->price)</span></p>
						</div>
					</div>
					<div class="col-xs-4">
						<label>Pilih Tamu</label>
						<select class="form-control select2" style="width: 100%;" id="guest" name="guest_id" onchange="getId(event)">
							@foreach($guests as $guest)
							<option value="{{ $guest->id }}">{{ $guest->name }}</option>
							@endforeach
						</select><hr/>
						<label>Note:</label>
						<p class="small">Jika Tamu belum terdaftar, <a href="{{ route('guest.create') }}" class="btn btn-xs btn-success">klik disini</a> untuk mendaftarkan Tamu.</p><hr/>
						<div class="row">
							<div class="col-xs-6">
								<input type="checkbox" id="checkbox" onclick="addBed()">
								<label for="checkbox">&nbsp;&nbsp;Tambahan Kasur</label>
							</div>
							<div class="col-xs-12" id="input" style="display:none">
								<input type="text" name="bed" class="form-control" placeholder="Jumlah Tambahan Kasur">
							</div>
						</div><br/>
						<div>
							<label>Diskon</label>
							<select class="form-control select2" style="width: 100%;" id="discount" name="discount_id">
								@foreach($discounts as $discount)
								<option value="{{ $discount->id }}">{{ $discount->name }} - {{ $discount->value }}%</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-xs-5">
						<div class="row">
							<div class="col-xs-6">
								<label>Dewasa</label>
								<input type="text" class="form-control" placeholder="Jumlah Orang Dewasa" name="adult">
							</div>
							<div class="col-xs-6">
								<label>Anak-anak</label>
								<input type="text" class="form-control" placeholder="Jumlah Anak-anak" name="child">
							</div>
						</div><br/>
						<label>Tipe Reservasi</label>
						<div class="">
							<select class="form-control select2-1" style="width: 100%;" id="type" name="type">
								@foreach($categories as $category)
								<option value="{{ $category->id }}">{{ $category->name }}</option>
								@endforeach
							</select>
						</div><br/>
						<div id="agency" style="display: none;">
							<label>Nama Instansi</label>
							<input type="text" name="agency" class="form-control">
							<input type="hidden" name="id_corporate" value="{{$id_corporate}}" id="id_corporate">
							<input type="hidden" name="id_government" value="{{$id_government}}" id="id_government">
						</div><br/>
						<label>Metode Pembayaran</label>
						<br/>
						<div class="row">
							<div class="col-xs-6">
								<input type="radio" value="Debit" class="" name="payment" id="debit" onclick="show();">
								&nbsp;<label for="debit">Debit</label>
							</div>
							<div class="col-xs-6">
								<input type="radio" value="Cash" class="" name="payment" id="cash" onclick="hide();">
								&nbsp;<label for="cash">Cash</label>
							</div>
							<div class="col-xs-12 card" id="card" style="display: none;"><br/>
								<select class="form-control select2-2" style="width: 100%;" name="card">
									@foreach($cards as $card)
									<option value="{{ $card->name }}">{{ $card->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<br/>
						<label>Keterangan</label>
						<textarea name="additional_info" class="form-control" placeholder="Informasi Tambahan"></textarea>
						<br/>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-primary pull-right">Simpan</button>
			</div>
			<!-- /.box-footer -->
		</form>
	</div>
</section>
<script>
    $(document).ready(function() {
        $('#type').change(function() {
	    	if ($(this).val() == $('#id_corporate').val() || $(this).val() == $('#id_government').val()) {
	    		$('#agency').show();
	    	} else {
	    		$('#agency').hide();
	    	}
	    });
    })
</script>
<script>
	function addBed() {
		var checkBox = document.getElementById("checkbox");
		var input = document.getElementById("input");
		if (checkBox.checked == true){
			input.style.display = "block";
		} else {
			input.style.display = "none";
		}
	}
</script>
<script type="text/javascript">
	function hide(){
		document.getElementById('card').style.display ='none';
	}
	function show(){
		document.getElementById('card').style.display = 'block';
	}

	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
	var yyyy = today.getFullYear();
	today = yyyy+mm+dd;
	function getId(e) {
		var room_id = document.getElementById("room_id").value;
		document.getElementById('invoice').value = 'INV-'+today+'-'+room_id+'-'+e.target.value
	}
</script>
<script>
	$(function () {
	    //Initialize Select2 Elements
	    $('.select2').select2()
	    $('.select2-1').select2()
	    $('.select2-2').select2()

//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	checkboxClass: 'icheckbox_minimal-blue',
	radioClass   : 'iradio_minimal-blue'
})
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
    	checkboxClass: 'icheckbox_minimal-red',
    	radioClass   : 'iradio_minimal-red'
    })
	    //Flat red color scheme for iCheck
	    $('input[type="radio"].flat-red').iCheck({
	    	checkboxClass: 'icheckbox_flat-green',
	    	radioClass   : 'iradio_flat-green'
	    })

	})
</script>
@endsection
