{{-- Modal Create Role  --}}
<div class="modal fade" id="createRoles" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h3 class="modal-title" id="createRoles">Tambah Roles</h3>
            </div>
            <div class="modal-body">
                <form role="form" action="{{ route('role.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Roles</label>
                        <input type="text" class="form-control" name="name" placeholder="Masukan Role">
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

{{-- Modal Edit Role  --}}
<div class="modal fade" id="editRoles" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h3 class="modal-title" id="editRole">Edit Roles</h3>
            </div>
            <div class="modal-body">
                <form id="rolesFormEdit" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    {{-- <input type="hidden" name="id" id="role_id"> --}}

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Roles</label>
                        <input type="text" class="form-control" name="name" id="role_name" placeholder="Masukan Roles" value="">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success edit_role"><i class="fa fa-edit"></i> Edit Data</button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- Modal Delete Role  --}}
<div class="modal fade" id="deleteRoles" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h3 class="modal-title" id="deleteRoles">Delete Roles</h3>
            </div>
            <div class="modal-body">
                <h5 id="text-delete"></h5>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger delete_role"><i class="fa fa-trash"></i> Hapus Data</button>
            </div>

        </div>
    </div>
</div>
