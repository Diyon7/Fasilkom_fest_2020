<div class="" id="manual">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="exampleFormControlInput1">Alamat Email Tujuan</label>
            <select class="custom-select" name="email" id="hemail" onchange="saatTekan()" required>
                <option value="">[Pilih]</option>
                <?php foreach ($peserta as $email) : ?>
                    <option value="<?= $email['email'] ?>"><?= $email['email'] ?></option>
                <?php endforeach; ?>
            </select>

            <!-- <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"> -->
        </div>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Subjek</label>
        <input type="text" name="subjek" class="form-control" onkeydown="saatTekan()" placeholder="subjek">
    </div>
    <div class="form-group">
        <hr>
        <label for="exampleFormControlTextarea1">Deskripsi</label>
        <div class="form-group">
            <textarea class="textarea" name="deskripsi" placeholder="Place some text here" style="width: 100%; height: 300px;">
                                        <p> &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad id, quis quo magnam dolores asperiores nobis ut eveniet illum adipisci eaque dolorum nisi dignissimos. Iste perferendis cum necessitatibus repellat nam!</p>
                                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad id, quis quo magnam dolores asperiores nobis ut eveniet illum adipisci eaque dolorum nisi dignissimos. Iste perferendis cum necessitatibus repellat nam!</p>
                                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad id, quis quo magnam dolores asperiores nobis ut eveniet illum adipisci eaque dolorum nisi dignissimos. Iste perferendis cum necessitatibus repellat nam!</p>
                                        <ul>
                                            <li>List item one</li>
                                            <li>List item two</li>
                                            <li>List item three</li>
                                            <li>List item four</li>
                                        </ul>
                                        <p>Thank you,</p>
                                        <p>John Doe</p>
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