{{-- Modal Create Acomodation  --}}
<div class="modal modal-default fade" id="createAcomodation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="createAcomodation">Tambah Room Acomodation</h3>
            </div>
            <div class="modal-body">
                <form role="form" action="{{ route('roomacomodation.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Room Acomodation</label>
                        <input type="hidden" name="room_id" value="{{$id}}">
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

{{-- Modal Edit Acomodation  --}}
<div class="modal modal-default fade" id="editAcomodation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="editAcomodation">Edit Room Acomodation</h3>
            </div>
            <div class="modal-body">
                <form id="acomodationFormEdit" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="acomodation_name">Nama Room Acomodation</label>
                        <input type="hidden" name="room_id" value="{{$id}}">
                        <input type="text" class="form-control" name="name" id="acomodation_name" placeholder="Masukan Kategori" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success edit_acomodation"><i class="fa fa-edit"></i> Edit Data</button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- Modal Delete Acomodation  --}}
<div class="modal modal-default fade" id="deleteAcomodation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="deleteAcomodation">Delete Room Acomodation</h3>
            </div>
            <div class="modal-body">
                <h5 id="text-delete"></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger delete_acomodation"><i class="fa fa-trash"></i> Hapus Data</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
