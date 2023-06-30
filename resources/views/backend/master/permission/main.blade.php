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
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createPermission"><i class="fa fa-plus-circle"></i> Tambah Permission</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="30">No</th>
                                <th>Nama</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editPermission" data-name="{{ $permission->name }}"  data-route="{{ route('permission.update', $permission->id) }}"><i class="fa fa-edit"></i></button>

                                    <button type="button" data-id="{{ $permission->id }}" data-name="{{ $permission->name }}" class="btn btn-danger" data-toggle="modal" data-target="#deletePermission"><i class="fa fa-trash"></i></button>
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

        $('#editPermission').on("show.bs.modal", (e) => {
            $('#rolesFormEdit').attr('action', $(e.relatedTarget).data('route'))
            $('#role_name').val($(e.relatedTarget).data('name'))
        })

        $('#deletePermission').on("show.bs.modal", (e) => {

            $('#text-delete').text("Yakin ingin Menghapus "+$(e.relatedTarget).data('name')+" ?")

            $('.delete_permission').click( () => {
                $.ajax({
                    url : "permission/"+$(e.relatedTarget).data('id'),
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
@include('backend.master.permission.m_permission')
@endsection
