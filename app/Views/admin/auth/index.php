<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css"> -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <?php if (isset($validation)) : ?>
                    <div class="alert alert-danger" role="alert"><?= $validation->listErrors() ?></div>
                <?php endif; ?>

                <!-- pesan error -->
                <?php if (session()->has('danger')) : ?>
                    <div class="alert alert-danger" role="alert"><?= session()->getFlashdata('danger') ?></div>
                <?php endif; ?>

                <?php if (session()->has('success')) : ?>
                    <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <?= form_open('admin/login') ?>
                <div class="input-group mb-3">
                    <input type="text" name="email" placeholder="Email" class="form-control" autocomplete="off">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <!-- <img src="upload/img/photo/57-191029071653.png" alt=""> -->
                <div class="input-group mb-3">
                    <input type="password" name="password" placeholder="Password" class="form-control">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
                <?= form_close(); ?>

            </div>
        </div>
    </div>

    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="/assets/dist/js/adminlte.min.js"></script> -->

</body>

</html>