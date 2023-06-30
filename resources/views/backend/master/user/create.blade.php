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
			<h3 class="box-title">Tambah User</h3>
		</div>
		<form class="form-horizontal" role="form" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
			<div class="box-body row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="name" class="col-sm-4 control-label">Nama</label>
						<div class="col-sm-8">
							<input type="text" name="name" class="form-control" id="name" placeholder="Nama">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-4 control-label">Email</label>
						<div class="col-sm-8">
							<input type="email" name="email" class="form-control" id="email" placeholder="Email">
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-sm-4 control-label">Password</label>
						<div class="col-sm-8">
							<input type="password" name="password" class="form-control" id="password" placeholder="Password">
						</div>
					</div>
					<input type="hidden" name="roles" value="Admin">
					{{--<div class="form-group">
						<label for="password" class="col-sm-4 control-label">Role</label>
						<div class="col-sm-8">
							<select class="form-control select2" multiple="multiple" name="roles[]" data-placeholder="Pilih Role Untuk User" style="width: 100%;">
								@foreach($roles as $role)
								<option value="{{ $role->id }}">{{ $role->name }}</option>
								@endforeach
							</select>
						</div>
					</div>--}}
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
@endsection
