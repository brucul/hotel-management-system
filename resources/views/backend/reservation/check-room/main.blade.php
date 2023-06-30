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
    <h3 class="box-title">Status Kamar</h3>
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
								<th>Nomor Kamar</th>
								<th>Nama Kamar</th>
								<th>Tipe</th>
								<th>Lokasi</th>
								<th>Harga</th>
								<th>Gambar</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
                            @php
                                $no = 1;
                            @endphp
							@foreach ($rooms as $room)
							<tr>
								<td>{{ $no++ }}</td>
								<td>{{ $room->number }}</td>
								<td>{{ $room->name }}</td>
								<td>{{ $room->category->name }}</td>
								<td>{{ $room->location }}</td>
								<td>@currency($room->price)</td>
								<td align="center">
									<img src="{{ asset('storage/backend/room/pict/'.$room->pict) }}" alt="" width="80">
								</td>
								<td align="center">
                                    <a class="btn btn-info" href="{{ route('check.show', $room->id) }}"><i class="fa fa-hotel"></i> </a>
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

@endsection
