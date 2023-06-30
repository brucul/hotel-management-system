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
			<h3 class="box-title">Tambah Kamar</h3>
		</div>
		<form class="form-horizontal" role="form" action="{{ route('room.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
			<div class="box-body row">
				<div class="col-md-8">
					<div class="form-group">
						<label for="nomor" class="col-sm-3">Nomor Kamar</label>
						<div class="col-sm-9">
							<input type="text" name="number" class="form-control" id="nomor" placeholder="Nomor Kamar">
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-sm-3">Nama Kamar</label>
						<div class="col-sm-9">
							<input type="text" name="name" class="form-control" id="name" placeholder="Nama Kamar">
						</div>
					</div>
					<div class="form-group">
						<label for="type" class="col-sm-3">Type</label>
						<div class="col-sm-9">
							<select class="form-control select2" style="width: 100%;" id="type" name="type">
								@foreach($categories as $category)
								<option value="{{ $category->id }}">{{ $category->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="loc" class="col-sm-3">Lokasi</label>
						<div class="col-sm-9">
							<input type="text" name="location" class="form-control" id="loc" placeholder="Lokasi">
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-sm-3">Harga Kamar</label>
						<div class="col-sm-9">
							<input type="text" name="price" class="form-control" id="price" placeholder="Harga Kamar">
						</div>
					</div>
					{{--<div class="form-group">
						<label for="discount" class="col-sm-3">Diskon</label>
						<div class="col-sm-9">
							<select class="form-control select2" style="width: 100%;" id="discount" name="discount" id="discount" placeholder="Diskon">
								@foreach($discounts as $discount)
								<option value="{{ $discount->id }}">{{ $discount->name }} - {{ $discount->value }}%</option>
								@endforeach
							</select>
						</div>
					</div>--}}
				</div>
				<div class="col-md-4">
					<div class="file-upload col-md-12">
						<div class="image-upload-wrap" id="image-upload-wrap-utama">
							<input class="file-upload-input" name="pict" type='file' onchange="readURLUtama(this);" accept="image/*" id="file-upload-input-utama" />
							<div class="drag-text">
								<h3>Foto Kamar</h3>
							</div>
                        </div>

						<div class="file-upload-content" id="file-upload-content-utama">
                            <img class="file-upload-image" src="#" alt="your image" id="file-upload-image-utama" />
                            <div class="image-title-wrap">
								<button type="button" onclick="removeUploadUtama()" class="btn btn-danger" id="image-title-utama"><i class="fa fa-times"></i></button>
							</div>
                        </div>
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
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
@endsection
