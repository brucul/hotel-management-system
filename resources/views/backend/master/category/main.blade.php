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
    <h3 class="box-title">Data category</h3>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCategory"><i class="fa fa-plus-circle"></i> Tambah Kategori</button>--}}
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="30">No</th>
                                <th>Nama</th>
                                <th width="50">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $category->name }}</td>
                                <td align="center">
                                    {{--<button type="button" data-route="{{ route('category.update', $category->id) }}" data-name="{{ $category->name }}" data-toggle="modal" data-target="#editCategory" class="btn btn-success"><i class="fa fa-edit"></i></button>--}}
                                    <a href="{{ route('category.show', $category->id) }}" class="btn btn-info"><i class="fa fa-info"></i></a>
                                    {{--<button type="button" data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-toggle="modal" data-target="#deleteCategory" class="btn btn-danger"><i class="fa fa-trash"></i></button>--}}
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

        $('#editCategory').on("show.bs.modal", (e) => {
            $('#categoryFormEdit').attr('action', $(e.relatedTarget).data('route'))
            $('#category_name').val($(e.relatedTarget).data('name'))
        })

        $('#deleteCategory').on("show.bs.modal", (e) => {

            $('#text-delete').text("Yakin ingin Menghapus "+$(e.relatedTarget).data('name')+" ?")

            $('.delete_category').click( () => {
                $.ajax({
                    url : "category/"+$(e.relatedTarget).data('id'),
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
@include('backend.master.category.m_category')
@endsection
