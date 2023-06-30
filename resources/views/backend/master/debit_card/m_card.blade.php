{{-- Modal Create Card  --}}
<div class="modal modal-default fade" id="createCard">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="createCard">Tambah Kartu Debit</h3>
            </div>
            <div class="modal-body">
                <form role="form" action="{{ route('card.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Kartu Debit</label>
                        <input type="hidden" name="parent_id" value="0">
                        <input type="text" class="form-control" name="name" placeholder="Masukan Kartu Debit">
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

{{-- Modal Edit Card  --}}
<div class="modal modal-default fade" id="editCard">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="editCard">Edit Kartu Debit</h3>
            </div>
            <div class="modal-body">
                <form id="cardFormEdit" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    {{-- <input type="hidden" name="id" id="card_id"> --}}

                    <div class="form-group">
                        <label for="card_name">Nama Kartu Debit</label>
                        <input type="hidden" name="parent_id" value="0">
                        <input type="text" class="form-control" name="name" id="card_name" placeholder="Masukan Kartu Debit" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success edit_card"><i class="fa fa-edit"></i> Edit Data</button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- Modal Delete Card  --}}
<div class="modal modal-default fade" id="deleteCard">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="deleteCard">Delete Kartu Debit</h3>
            </div>
            <div class="modal-body">
                <h5 id="text-delete"></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger delete_card"><i class="fa fa-trash"></i> Hapus Data</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->