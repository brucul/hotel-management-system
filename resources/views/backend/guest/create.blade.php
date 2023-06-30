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
			<h3 class="box-title">Tambah Tamu</h3>
		</div>
		<form class="form-horizontal" role="form" action="{{ route('guest.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
			<div class="box-body row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="nik" class="col-sm-3 control-label">Nomor NIK</label>
						<div class="col-sm-8">
							<input type="text" name="nik" class="form-control" id="nik" placeholder="Nomor NIK">
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-sm-3 control-label">Nama Lengkap</label>
						<div class="col-sm-8">
							<input type="text" name="name" class="form-control" id="name" placeholder="Nama Lengkap">
						</div>
					</div>
                    <div class="form-group">
						<label for="email" class="col-sm-3 control-label">Email</label>
						<div class="col-sm-8">
							<input type="email" name="email" class="form-control" id="email" placeholder="Email">
						</div>
					</div>
                    <div class="form-group">
						<label for="phone" class="col-sm-3 control-label">Nomor Telepon</label>
						<div class="col-sm-8">
							<input type="text" name="phone" class="form-control" id="phone" placeholder="Nomor Telepon">
						</div>
					</div>
                    <div class="form-group">
						<label for="type" class="col-sm-3 control-label">Type</label>
						<div class="col-sm-8">
							<select class="form-control select2" style="width: 100%;" id="type" name="type">
								@foreach($categories as $category)
								<option value="{{ $category->id }}">{{ $category->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
						<label for="address" class="col-sm-3 control-label">Alamat Tamu</label>
						<div class="col-sm-8">
                            <textarea class="form-control" name="address" id="address" placeholder="Alamat Tamu"></textarea>
						</div>
					</div>
                    <div class="form-group">
						<label for="city" class="col-sm-3 control-label">Kota</label>
						<div class="col-sm-8">
							<input type="text" name="city" class="form-control" id="city" placeholder="Kota">
						</div>
					</div>
                    <div class="form-group">
						<label for="country" class="col-sm-3 control-label">Warga Negara</label>
						<div class="col-sm-8">
							<select class="form-control select2-1" id="country" name="country">
								<option value="Indonesia">Indonesia</option>
								<option value="Luar Negeri">Luar Negeri</option>
							</select>
						</div>
					</div>
                    <div class="form-group">
						<label for="additional_info" class="col-sm-3 control-label">Informasi Tambahan</label>
						<div class="col-sm-8">
                            <textarea class="form-control" name="additional_info" id="additional_info" placeholder="Informasi Tambahan"></textarea>
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
    $('.select2-1').select2()
  })
</script>
@endsection
