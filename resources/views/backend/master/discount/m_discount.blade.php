{{-- Modal Create Discount  --}}
<div class="modal modal-default fade" id="createDiscount">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="createDiscount">Tambah Diskon</h3>
            </div>
            <div class="modal-body">
                <form role="form" action="{{ route('discount.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Discount</label>
                        <input type="text" class="form-control" name="name" placeholder="Masukan Nama Discount">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nilai Diskon</label>
                        <input type="text" class="form-control" name="value" placeholder="Masukan Nilai Discount">
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

{{-- Modal Edit Discount  --}}
<div class="modal modal-default fade" id="editDiscount">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="editDiscount">Edit Diskon</h3>
            </div>
            <div class="modal-body">
                <form id="discountFormEdit" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    {{-- <input type="hidden" name="id" id="discount_id"> --}}

                    <div class="form-group">
                        <label for="discount_name">Nama Discount</label>
                        <input type="text" class="form-control" name="name" id="discount_name" placeholder="Masukan Nama Discount" value="">
                    </div>
                    <div class="form-group">
                        <label for="discount_value">Nilai Discount</label>
                        <input type="text" class="form-control" name="value" id="discount_value" placeholder="Masukan Nilai Discount" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success edit_discount"><i class="fa fa-edit"></i> Edit Data</button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- Modal Delete Discount  --}}
<div class="modal modal-default fade" id="deleteDiscount">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="deleteDiscount">Delete Diskon</h3>
            </div>
            <div class="modal-body">
                <h5 id="text-delete"></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger delete_discount"><i class="fa fa-trash"></i> Hapus Data</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->