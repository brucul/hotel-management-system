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
                                <th>Tanggal Check In</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($guests as $guest)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $guest->guest->name }}</td>
                                <td>{{ $guest->guest->phone }}</td>
                                <td>{{ $guest->guest->email }}</td>
                                <td>{{ $guest->guest->address }}</td>
                                <td>{{ $guest->check_in }}</td>
                                <td>
                                    <input type="button" class="btn btn-sm btn-success" value="Guest In House">
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
