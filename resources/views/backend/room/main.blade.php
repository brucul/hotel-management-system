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
                    <a href="{{ route('room.create') }}" class="btn btn-primary"> Tambah Kamar</a>
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
								<td>
									<a class="btn btn-success" href="{{ route('room.edit', $room->id) }}"><i class="fa fa-edit"></i> Edit</a>
                                    <a class="btn btn-info" href="{{ route('roomacomodation.show', $room->id) }}"><i class="fa fa-hotel"></i> </a>
									<button class="btn btn-danger" data-id="{{ $room->id }}" data-name="{{ $room->name }}" data-toggle="modal" data-target="#deleteRoom"><i class="fa fa-trash-alt"></i> Hapus</button>
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

{{-- Modal Delete --}}
<div class="modal modal-default fade" id="deleteRoom">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title" id="deleteRoom">Delete Kamar</h3>
			</div>
			<div class="modal-body">
				<h5 id="text-delete"></h5>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-danger delete_room"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
	$(document).ready(function() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$('#deleteRoom').on("show.bs.modal", (e) => {

			$('#text-delete').text("Yakin ingin Menghapus "+$(e.relatedTarget).data('name')+" ?")

			$('.delete_room').click( () => {
				$.ajax({
					url : "room/"+$(e.relatedTarget).data('id'),
					method : "POST",
					cache : false,
					data : {
						_method: "DELETE",
					},
					success : (res) => {
						location.reload()
					}
				})
			})
		})

	})
</script>
@endsection
