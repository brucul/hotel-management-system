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
        <h3 class="box-title">Data Tamu</h3>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{ route('guest.create') }}" class="btn btn-primary"> Tambah Tamu</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No. Telp</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($guests as $guest)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $guest->name }}</td>
                                <td>{{ $guest->phone }}</td>
                                <td>{{ $guest->email }}</td>
                                <td>{{ $guest->address }}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('guest.edit', $guest->id) }}"><i class="fa fa-edit"></i> Edit</a>

                                    <button type="button" data-id="{{ $guest->id }}" data-name="{{ $guest->name }}" class="btn btn-danger" data-toggle="modal" data-target="#deleteGuest"><i class="fa fa-trash"></i> Hapus</button>
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
<div class="modal modal-default fade" id="deleteGuest">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title" id="deleteGuest">Delete Tamu</h3>
			</div>
			<div class="modal-body">
				<h5 id="text-delete"></h5>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-danger delete_guest"><i class="fa fa-trash"></i> Hapus Data</button>
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

		$('#deleteGuest').on("show.bs.modal", (e) => {

			$('#text-delete').text("Yakin ingin Menghapus "+$(e.relatedTarget).data('name')+" ?")

			$('.delete_guest').click( () => {
				$.ajax({
					url : "guest/"+$(e.relatedTarget).data('id'),
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
