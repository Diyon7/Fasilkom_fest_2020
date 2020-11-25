<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" text="text/css" href="<?= base_url() ?>/assets/plugins/utama/css/bootstrap.min.css">
  <link rel="stylesheet" text="text/css" href="<?= base_url() ?>/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css" />
  <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script src="<?= base_url() ?>/assets/plugins/utama/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/utama/css/stylecsologin.css">
  <title>Sign in & Sign up Form</title>
  <style>
    .no-spinners {
      -moz-appearance: textfield;
    }

    .no-spinners::-webkit-outer-spin-button,
    .no-spinners::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
  </style>
</head>

<body>
  <div class="containercso">
    <div class="forms-containercso">
      <div class="signin-signup">
        <?= form_open('', ['class' => 'sign-in-form']) ?>
        <h2 class="title">Sign in</h2>
        <div class="input-field">
          <i class="fas fa-envelope"></i>
          <input type="text" name="email" placeholder="Email" />
        </div>
        <div class="input-field">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" placeholder="Password" />
        </div>
        <input type="submit" value="Login" class="btn solid" />
        <?= form_close() ?>


        <?= form_open_multipart('cso/save', ['class' => 'sign-up-form']) ?>
        <?= csrf_field() ?>

        <div class="input-field">
          <i class="fas fa-user"></i>
          <input type="text" name="nama" placeholder="Nama Lengkap" />
        </div>
        <div class="input-field">
          <i class="fas fa-envelope"></i>
          <input type="number" name="nowhatsapp" class="no-spinners" placeholder="No Whatsapp" />
        </div>
        <div class="input-field">
          <i class="fas fa-envelope"></i>
          <input type="text" name="email" placeholder="example@examplecom" />
        </div>
        <!-- <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="text" name="asalsekolah" placeholder="asal sekolah" />
          </div> -->
        <div class="input-field">
          <i class="fas fa-envelope"></i>
          <input type="text" name="asalsekolah" placeholder="asal sekolah" />
        </div>
        <div class="input">
          <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
              <img src="" alt="" />
            </div>
            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
            <div>
              <span class="btn btn-file">
                <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Gambar</span>
                <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                <input type="file" name="fototeam" class="default" />
              </span>
            </div>
          </div>
        </div>
        <div class="input-field">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" placeholder="Password" />
        </div>
        <input type="submit" class="btn" value="Sign up" />
        <?= form_close() ?>
      </div>
    </div>

    <div class="panels-containercso">
      <div class="panel left-panel">
        <div class="content">
          <h3>Belum Punya akun ?</h3>
          <p>
            Silahkan mendaftar untuk mengikuti Computer Science Competition Fasilkom Fest 2020
          </p>
          <button class="btn transparent" id="sign-up-btn">
            Sign up
          </button>
        </div>
        <img src="img/log.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>Sudah mempunyai akun ?</h3>
          <p>
            Silahkan mendaftar untuk mengikuti Computer Science Competition Fasilkom Fest 2020
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Sign in
          </button>
        </div>
        <img src="img/register.svg" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="<?= base_url() ?>/assets/plugins/utama/js/appcsologin.js"></script>
</body>

</html>