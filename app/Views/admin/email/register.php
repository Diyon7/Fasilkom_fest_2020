<div class="" id="register">
    <div class="form-group col-md-6">
        <label for="exampleFormControlInput1">Alamat Email Tujuan</label>
        <select class="custom-select" name="email" id="hemail" required>
            <option value="">[Pilih]</option>
            <?php foreach ($peserta as $email) : ?>
                <option value="<?= $email['email'] ?>"><?= $email['email'] ?></option>
            <?php endforeach; ?>
        </select>

        <!-- <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"> -->
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Subjek</label>
        <input type="text" name="subjek" class="form-control" value="Register Success">
    </div>
    <div class="form-group">
        <hr>
        <label for="exampleFormControlTextarea1">Deskripsi</label>
        <div class="form-group">
            <textarea class="textarea" name="deskripsi" placeholder="Place some text here" style="width: 100%; height: 300px;">
            <p>Selamat, tim <-----o0o-----> telah berhasil terdaftar dalam sistem untuk mengikuti lomba Computer Science Olympiad. </p><p><br></p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mohon melengkapi data tim Anda pada halaman dashboard dan transfer ke rekening 1234567890 a.n. Lugito Michael sebesar 100040 paling lambat 31 Agustus 2018, jika sudah mentransfer sesuai nominal yang dicantumkan mohon untuk konfirmasi admin bisa menghubungi langsung ke 089676653098 (call/WA) maupun klik button Lapor Sudah Bayar pada menu dashboard akun Anda.</p>
            <p><br></p><p style="text-align: right; ">Salam Panitia FasilkomFest2020</p>
                                        
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


        <script>
            $(function() {
                // Summernote
                $('.textarea').summernote()
            })
        </script>