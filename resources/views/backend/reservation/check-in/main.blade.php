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
	@if (session()->has('success'))
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">×</button>
		{!! session()->get('success')!!}
	</div>
	@endif
	<h3 class="box-title">Data Kamar</h3>
	<div class="row">
		<div class=" col-sm-6">
			<form class="form-horizontal" role="form" action="{{ route('checkin') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Cari Nomor Kamar" name="search" id="search">
					<div class="input-group-btn">
						<button type="submit" class="btn btn-success">Cari</button>
					</div>
					<!-- /btn-group -->
				</div>
			</form>
		</div>
		<div class="col-sm-6">
			<select class="form-control select2" id="category" style="width: 100%;" onchange="filter(event)">
				<option value="all">All</option>
				@foreach ($categories as $category)
				<option value="{{ $category->id }}">{{ $category->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		@foreach ($rooms as $room)
		<div class="col-md-3 filter {{ $room->category->id }}">
			<!-- Widget: user widget style 1 -->
			<div class="box box-widget widget-user">
				<!-- Add the bg color to the header using any of the bg-* classes -->
				<a href="{{ route('checkin.create', $room->id) }}">
					<div class="widget-user-header bg-black" style="background: url( {{ asset('storage/backend/room/pict/'.$room->pict) }} ) ; background-size: cover">
					</div>
				</a>
				<div class="box-footer">
					<div class="row">
						<div class="col-sm-6 border-right">
							<div class="description-block">
								<span class="description-text">No. Kamar</span>
								<h5 class="description-header">{{ $room->number }}</h5>
							</div>
							<!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-6">
							<div class="description-block">
								<span class="description-text">Tipe</span>
								<h5 class="description-header">{{ $room->category->name }}</h5>
							</div>
							<!-- /.description-block -->
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
			</div>
			<!-- /.widget-user -->
		</div>
		@endforeach
	</div>
	<!-- /.row -->
</section>
<!-- /.content -->
<script>
	$(function () {
	    //Initialize Select2 Elements
	    $('.select2').select2()
	})
</script>
<script type="text/javascript">
	function filter(e) {
		var value = document.getElementById('category').value;

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
	}
</script>
@endsection
