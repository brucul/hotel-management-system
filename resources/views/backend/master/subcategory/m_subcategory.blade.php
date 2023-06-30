{{-- Modal Create Category  --}}
<div class="modal modal-default fade" id="createCategory">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="createCategory">Tambah Sub-Kategori</h3>
            </div>
            <div class="modal-body">
                <form role="form" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Sub-Kategori</label>
                        <input type="hidden" name="parent_id" value="{{$id}}">
                        <input type="text" class="form-control" name="name" placeholder="Masukan Kategori">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Category  --}}
<div class="modal modal-default fade" id="editCategory">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="editCategory">Edit Sub-Kategori</h3>
            </div>
            <div class="modal-body">
                <form id="categoryFormEdit" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    {{-- <input type="hidden" name="id" id="category_id"> --}}

                    <div class="form-group">
                        <label for="category_name">Nama Kategori</label>
                        <input type="hidden" name="parent_id" value="{{$id}}">
                        <input type="text" class="form-control" name="name" id="category_name" placeholder="Masukan Kategori" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success edit_category"><i class="fa fa-edit"></i> Edit Data</button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- Modal Delete Category  --}}
<div class="modal modal-default fade" id="deleteCategory">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="deleteCategory">Delete Sub-Kategori</h3>
            </div>
            <div class="modal-body">
                <h5 id="text-delete"></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger delete_category"><i class="fa fa-trash"></i> Hapus Data</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->