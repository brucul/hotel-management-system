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
    <h3 class="box-title">Data Discount</h3>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createDiscount"><i class="fa fa-plus-circle"></i> Tambah Discount</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="30">No</th>
                                <th>Nama</th>
                                <th>Discount</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($discounts as $discount)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $discount->name }}</td>
                                <td>{{ $discount->value }}%</td>
                                <td>
                                    <button type="button" data-route="{{ route('discount.update', $discount->id) }}" data-name="{{ $discount->name }}" data-value="{{ $discount->value }}" data-toggle="modal" data-target="#editDiscount" class="btn btn-success"><i class="fa fa-edit"></i></button>

                                    <button type="button" data-id="{{ $discount->id }}" data-name="{{ $discount->name }}" data-toggle="modal" data-target="#deleteDiscount" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#editDiscount').on("show.bs.modal", (e) => {
            $('#discountFormEdit').attr('action', $(e.relatedTarget).data('route'))
            $('#discount_name').val($(e.relatedTarget).data('name'))
            $('#discount_value').val($(e.relatedTarget).data('value'))
        })

        $('#deleteDiscount').on("show.bs.modal", (e) => {

            $('#text-delete').text("Yakin ingin Menghapus "+$(e.relatedTarget).data('name')+" ?")

            $('.delete_discount').click( () => {
                $.ajax({
                    url : "discount/"+$(e.relatedTarget).data('id'),
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
@include('backend.master.discount.m_discount')
@endsection
