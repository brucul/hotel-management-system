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
	<h3 class="box-title">Data Kamar</h3>

</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="example1" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>No.</th>
								<th>Invoice</th>
								<th>Nama Tamu</th>
								<th>Tipe Kamar</th>
								<th>Nomor Kamar</th>
								<th>Jumlah Hari</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@php
							$no = 1;
							$today = new DateTime(date('Y-m-d'));
							@endphp
							@foreach ($reservations as $reservation)
							<tr>
								<td>{{ $no++ }}</td>
								<td>{{ $reservation->payment->invoice }}</td>
								<td>{{ $reservation->guest->name }}</td>
								<td>{{ $reservation->room->category->name }}</td>
								<td>{{ $reservation->room->number }}</td>
								<td>{{ $today->diff(new DateTime($reservation->check_in))->days }} Hari</td>
								<td>
									<a class="btn btn-success" href="{{ route('checkout.create', $reservation->id) }}"><i class="fa fa-edit"></i> Check Out</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
<!-- /.content -->
<script type="text/javascript">
	/*	gallery */
	$(document).ready(function(){

		$(".filter-button").click(function(){
			var value = $(this).attr('data-filter');

			if(value == "all")
			{
				$('.filter').show('1000');
			}
			else
			{
				$(".filter").not('.'+value).hide('3000');
				$('.filter').filter('.'+value).show('3000');

			}

			if ($(".filter-button").removeClass("active")) {
				$(this).removeClass("active");
			}
			$(this).addClass("active");
		});
	});
	/*	end gallery */

	$(document).ready(function(){
		$(".fancybox").fancybox({
			openEffect: "none",
			closeEffect: "none"
		});
	});
</script>
@endsection
