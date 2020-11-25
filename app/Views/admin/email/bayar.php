<div class="" id="bayar">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="exampleFormControlInput1">Alamat Email Tujuan</label>
            <select class="custom-select" name="email" id="hemail" onchange="saatTekan()" required>
                <option value="">[Pilih]</option>
                <?php foreach ($peserta as $email) : ?>
                    <option value="<?= $email['email'] ?>"><?= $email['email'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Subjek</label>
        <input type="text" name="subjek" class="form-control" onkeydown="saatTekan()" value="Pembayaran Berhasil">
    </div>
    <div class="form-group">
        <hr>
        <label for="exampleFormControlTextarea1">Deskripsi</label>
        <div class="form-group">
            <textarea class="textarea" name="deskripsi" placeholder="Place some text here" style="width: 100%; height: 300px;">
                                        <p> &nbsp; &nbsp; &nbsp;Selamat ya broo ws bayar ya enak wes gari lombane ndang sinau sing getu</p>
                                        </textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-5">

        </div>
    </div>
</div>
<div class="card-footer">
    <div class="float-right">

        <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i><input type="submit" class="btn btn-primary" value="Kirim Email"></button>
        <?= form_close() ?>


        <script>
            $(function() {
                // Summernote
                $('.textarea').summernote()
            })
        </script>