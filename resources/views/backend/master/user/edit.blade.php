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
			<h3 class="box-title">Edit User</h3>
		</div>
		<form class="form-horizontal" role="form" action="{{ route('user.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
			<div class="box-body row">
				<div class="col-sm-3">
					<div class="file-upload col-md-12">
						<div class="image-upload-wrap" id="image-upload-wrap-utama">
							<input class="file-upload-input" name="pict" type='file' onchange="readURLUtama(this);" accept="image/*" id="file-upload-input-utama" />
							<div class="drag-text">
								<h3>Foto</h3>
							</div>
                        </div>

						<div class="file-upload-content" id="file-upload-content-utama">
                            <img class="file-upload-image" src="{{ asset('storage/backend/user/'.$profile->pict) }}" alt="your image" id="file-upload-image-utama" />
                            <div class="image-title-wrap">
								<button type="button" onclick="removeUploadUtama()" class="btn btn-danger" id="image-title-utama"><i class="fa fa-times"></i></button>
							</div>
                        </div>
                    </div>
				</div>
				<div class="col-md-9"><br/>
					<div class="form-group">
						<label for="name" class="col-sm-2">Nama</label>
						<div class="col-sm-10">
							<input type="text" name="name" class="form-control" id="name" placeholder="Nama" value="{{ $profile->name }}">
						</div>
					</div>
					<div class="form-group">
						<label for="phone" class="col-sm-2">No. Telp</label>
						<div class="col-sm-10">
							<input type="text" name="phone" class="form-control" id="phone" placeholder="No. Telp" value="{{ $profile->phone }}">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2">Email</label>
						<div class="col-sm-10">
							<input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ $profile->user->email }}">
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-sm-2">Password</label>
						<div class="col-sm-10">
							<input type="password" name="password" class="form-control" id="password" placeholder="Password">
						</div>
					</div>
					<input type="hidden" name="roles" value="Admin">
					{{--<div class="form-group">
						<label for="password" class="col-sm-2">Role</label>
						<div class="col-sm-10">
							<select class="form-control select2" multiple="multiple" name="roles[]" data-placeholder="Pilih Role Untuk User" style="width: 100%;">
								@foreach($roles as $role)
								<option value="{{ $role->id }}" {{ $role->name == $user->hasAnyRole($role->name) ? "selected" : "" }}>{{ $role->name }}</option>
								@endforeach
							</select>
						</div>
					</div>--}}
					<div class="form-group">
						<label for="address" class="col-sm-2">Alamat</label>
						<div class="col-sm-10">
							<textarea name="address" class="form-control" id="address">{{ $profile->address }}</textarea>
						</div>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-success pull-right">Simpan</button>
			</div>
			<!-- /.box-footer -->
		</form>
	</div>
</section>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
<script type="text/javascript">

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        main_image = "{{ $profile->pict }}"

        if(main_image == "default") {
            $('#image-upload-wrap-utama').show()
        } else {
            $('#file-upload-content-utama').show()
            $('#image-upload-wrap-utama').hide()
        }

    });
</script>
@endsection
