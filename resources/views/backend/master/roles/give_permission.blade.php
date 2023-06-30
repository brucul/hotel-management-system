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
    <h3 class="box-title">Data Permission</h3>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <form class="form-horizontal" role="form" action="{{ route('give_permission', $role->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    @foreach ($permissions as $permission)
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="checkbox" name="name[]" value="{{ $permission->name }}" {{ $permission->name == $role->hasPermissionTo($permission->name) ? "checked" : "" }}>
                            </span>
                            <input type="text" class="form-control" value="{{ $permission->name }}" readonly>
                        </div>
                        <!-- /input-group -->
                    </div>
                    @endforeach
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-success pull-right">Simpan</button>
                </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection
