@extends('backend.main')
@section('content')
<section class="content-header">
    <h1>
        Hotel Management System
        <small>Grand Dian Hotel Slawi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">{{ $title }}</a></li>
        <li class="active">{{ $sub_title }}</li>
    </ol>
    <hr/>
    <h3 class="box-title">Daily Report</h3>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{ route('report.export') }}" class="btn btn-success">Export Excel</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="30">No</th>
                                <th>Tipe Kamar</th>
                                <th>No. Kamar</th>
                                <th>Harga Kamar</th>
                                <th>Extra Bed</th>
                                <th>Breakfast</th>
                                <th>Diskon Kamar</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                                $total = 0;
                            @endphp
                            @foreach ($reservations as $reservation)
                            @php
                            $total = $total+$reservation->payment->payment_total-(($breakfast * ($reservation->adult)) + (($breakfast/2) * $reservation->children));
                            @endphp
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $reservation->room->category->name }}</td>
                                <td>{{ $reservation->room->number }}</td>
                                <td>
                                    @currency($reservation->room->price)
                                </td>
                                <td>+ @currency($reservation->bed*$bed)</td>
                                <td>- @currency(
                                        ($breakfast * ($reservation->adult)) + (($breakfast/2) * $reservation->children)
                                    )</td>
                                <td>{{ $reservation->discount->value }}% (@currency($reservation->room->price*$reservation->discount->value/100))</td>
                                <td>@currency($reservation->payment->payment_total - (($breakfast * ($reservation->adult)) + (($breakfast/2) * $reservation->children)))</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="7" align="center"><h2>Total</h2></th>
                                <th><h2>@currency($total)</h2></th>
                                
                            </tr>
                        </tfoot>
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