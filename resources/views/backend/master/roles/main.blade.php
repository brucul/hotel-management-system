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
    <h3 class="box-title">Data role</h3>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createRoles"><i class="fa fa-plus-circle"></i> Tambah Role</button>
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
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editRoles" data-name="{{ $role->name }}"  data-route="{{ route('role.update', $role->id) }}"><i class="fa fa-edit"></i></button>

                                    <a class="btn btn-info" href="{{ route('role.show', $role->id) }}"><i class="fa fa-info"></i> </a>

                                    <button type="button" data-id="{{ $role->id }}" data-name="{{ $role->name }}" class="btn btn-danger" data-toggle="modal" data-target="#deleteRoles"><i class="fa fa-trash"></i></button>
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

        $('#editRoles').on("show.bs.modal", (e) => {
            $('#rolesFormEdit').attr('action', $(e.relatedTarget).data('route'))
            $('#role_name').val($(e.relatedTarget).data('name'))
        })

        $('#deleteRoles').on("show.bs.modal", (e) => {

            $('#text-delete').text("Yakin ingin Menghapus "+$(e.relatedTarget).data('name')+" ?")

            $('.delete_role').click( () => {
                $.ajax({
                    url : "role/"+$(e.relatedTarget).data('id'),
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
@include('backend.master.roles.m_roles')
@endsection
