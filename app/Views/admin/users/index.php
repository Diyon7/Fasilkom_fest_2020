<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('isi') ?>

<div class="align-item-center">
    <div class="row">
        <div class="col">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tabel Soal</h4>
                    </div>
                    <div class="card-body viewdata">
                        <div class="form-row">


                            <div class="col-xs-11">
                                <p>
                                    <button type="submit" class="btn btn-primary tambahuser">
                                        <i class="fas fa-plus-circle"></i> Tambah Admin
                                    </button>
                                </p>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="datauser" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-sm">
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>CreateAt</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>CreateAt</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="vieweditdata" style="display: none;"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus data ini.</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="<?= base_url('admin/users/delete') ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" id="delete-input-id" name="id" value="">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- <div class="container" tabindex="-1" role="dialog" id="deleteModal">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <form action="<?= base_url('admin/users/delete') ?>" method="POST">
        <?= csrf_field(); ?>
        <input type="hidden" id="delete-input-id" name="id" value="">
        <button type="submit" class="btn btn-danger">Hapus</button>
    </form>
</div> -->



<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#datauser').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('ajax/getusers') ?>",
                "type": "POST",
                "data": {
                    csrf_test_name: $('input[name=csrf_test_name]').val()
                },
                "data": function(data) {
                    data.csrf_test_name = $('input[name=csrf_test_name]').val();
                },
                "dataSrc": function(response) {
                    $('input[name=csrf_test_name]').val(response.csrf_test_name);
                    return response.data;
                },
            },
            "columnDefs": [{
                "targets": [],
                "orderable": false,
            }, ],
        });

        $('.tambahuser').click(function(e) {
            $.ajax({
                url: "<?= site_url('ajax/users/formadd') ?>",
                type: "POST",
                data: {
                    csrf_test_name: $('input[name=csrf_test_name]').val()
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        $('.vieweditdata').html(response.sukses).show();
                        $('#tambahdata').modal('show');
                    }
                    $('input[name=csrf_test_name]').val(response.csrf_test_name);
                },
                error: function(xhr, ajaxOption, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        })


        $('#datauser tbody').on('click', '.btn-delete', function(e) {
            const id = e.target.dataset.id;
            $('#deleteModal #delete-input-id').val(id);
            $('#deleteModal').modal();
        })

    });
</script>


<?= $this->endSection() ?>