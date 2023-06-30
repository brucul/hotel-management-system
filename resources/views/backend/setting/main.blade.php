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
			<h3 class="box-title">Pengaturan</h3>
		</div>
		<form class="form-horizontal" role="form" action="{{ route('setting.update', $getsetting->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PATCH')
			<div class="box-body row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-body">
							<ul class="nav nav-tabs" role="tablist" id="myTab">
								<li class="active"><a href="#setting" role="tab" data-toggle="tab">Pengaturan Aplikasi</a></li>
								<li><a href="#bed" role="tab" data-toggle="tab">Harga Kasur Tambahan</a></li>
								<li><a href="#breakfast" role="tab" data-toggle="tab">Harga Breakfast</a></li>
								<li><a href="#detail" role="tab" data-toggle="tab">Detail Hotel</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane active" id="setting">
						<div class="box-body row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col-sm-3">
												<div class="file-upload col-md-12">
													<div class="image-upload-wrap" id="image-upload-wrap-utama">
														<input class="file-upload-input" name="pict" type='file' onchange="readURLUtama(this);" accept="image/*" id="file-upload-input-utama" />
														<div class="drag-text">
															<h3>Logo Hotel</h3>
														</div>
													</div>

													<div class="file-upload-content" id="file-upload-content-utama">
														<img class="file-upload-image" src="{{ asset('storage/backend/setting/pict/'.$getsetting->pict) }}" alt="your image" id="file-upload-image-utama" />
														<div class="image-title-wrap">
															<button type="button" onclick="removeUploadUtama()" class="btn btn-danger" id="image-title-utama"><i class="fa fa-times"></i></button>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-9"><br/>
												<div class="form-group">
													<label for="name" class="col-sm-2">Nama Aplikasi</label>
													<div class="col-sm-10">
														<input type="text" name="app_name" class="form-control" id="name" placeholder="Nama Aplikasi" value="{{ $getsetting->apk_name }}">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane" id="bed">
						<div class="box-body row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<div class="col-md-12"><br/>
											<div class="form-group">
												<label for="bed" class="col-sm-3">Harga Kasur Tambahan</label>
												<div class="col-sm-9">
													<input type="text" name="bed" class="form-control" id="bed" placeholder="Harga Kasur Tambahan" value="{{ $getsetting->bed }}">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane" id="breakfast">
						<div class="box-body row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<div class="col-md-12"><br/>
											<div class="form-group">
												<label for="breakfast" class="col-sm-3">Harga Breakfast</label>
												<div class="col-sm-9">
													<input type="text" name="breakfast" class="form-control" id="breakfast" placeholder="Harga Breakfast" value="{{ $getsetting->breakfast }}">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane" id="detail">
						<div class="box-body row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body"><br/>
										<div class="col-md-6">
											<div class="form-group">
												<label for="name" class="col-sm-3">Nama Hotel</label>
												<div class="col-sm-9">
													<input type="text" name="hotel_name" class="form-control" id="hotel_name" placeholder="Nama Hotel"value="{{ $getsetting->hotel_name }}">
												</div>
											</div>

											<div class="form-group">
												<label for="name" class="col-sm-3">Alamat</label>
												<div class="col-sm-9">
													<textarea class="form-control" name="address" id="address" placeholder="Alamat Hotel">{{ $getsetting->address }}</textarea>
												</div>
											</div>

											<div class="form-group">
												<label for="name" class="col-sm-3"></label>
												<div class="col-sm-4">
													<input type="text" name="regency" class="form-control" id="regency" placeholder="Kota" value="{{ $getsetting->regency }}">
												</div>
												<div class="col-sm-4 pull-right">
													<input type="text" name="province" class="form-control" id="province" placeholder="Provinsi" value="{{ $getsetting->province }}">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for="name" class="col-sm-3">Nomor Telepon</label>
												<div class="col-sm-9">
													<input type="text" name="phone" class="form-control" id="phone" placeholder="Nomor Telepon" value="{{ $getsetting->phone }}">
												</div>
											</div>

											<div class="form-group">
												<label for="name" class="col-sm-3">Nomor Fax</label>
												<div class="col-sm-9">
													<input type="text" name="number_fax" class="form-control" id="number_fax" placeholder="Nomor Fax" value="{{ $getsetting->number_fax }}">
												</div>
											</div>

											<div class="form-group">
												<label for="name" class="col-sm-3">Email</label>
												<div class="col-sm-9">
													<input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ $getsetting->email }}">
												</div>
											</div>

											<div class="form-group">
												<label for="name" class="col-sm-3">Website</label>
												<div class="col-sm-9">
													<input type="text" name="website" class="form-control" id="website" placeholder="Nama Hotel" value="{{ $getsetting->website }}">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
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

<script type="text/javascript">

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        main_image = "{{ $getsetting->pict }}"

        if(main_image == "default") {
            $('#image-upload-wrap-utama').show()
        } else {
            $('#file-upload-content-utama').show()
            $('#image-upload-wrap-utama').hide()
        }

    });
</script>
@endsection
