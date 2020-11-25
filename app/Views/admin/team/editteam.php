<div class="modal fade" id="editdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $name ?></h5><br>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="exampleModalLabel"><?= $school_name ?></h5>
                <?= form_open('ajax/updatedata') ?>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <label for="validationDefault01">Registrasi</label>
                        <select class="custom-select" id="validationDefault04" name="valid_bayar" required>
                            <option value="1" <?php if ($valid_bayar == '1') echo "selected" ?>>Belum Membayar</option>
                            <option value="2" <?php if ($valid_bayar == '2') echo "selected" ?>>Menunggu Konfirmasi</option>
                            <option value="3" <?php if ($valid_bayar == '3') echo "selected" ?>>Sudah Membayar</option>
                        </select>
                        <form action="">
                            <input type="hidden" name="email">

                        </form>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationDefault02">Pembayaran</label>
                        <select class="custom-select" id="validationDefault04" name="valid_register_data" required>
                            <option value="1" <?php if ($valid_register_data == "1") echo "selected"; ?>>Belum Valid</option>
                            <option value="2" <?php if ($valid_register_data == "2") echo "selected"; ?>>Menunggu Konfirmasi</option>
                            <option value="3" <?php if ($valid_register_data == "3") echo "selected"; ?>>Valid</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Update">
                    <?= form_close(); ?>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>