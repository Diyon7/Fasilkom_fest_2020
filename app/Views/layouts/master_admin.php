<?php $session = \Config\Services::session(); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/daterangepicker/daterangepicker.css"> -->
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.js"></script>
  <script src="<?= base_url() ?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <!-- <script src="<?= base_url() ?>/assets/plugins/datatables-select/js/dataTables.select.min.js"></script>
  <script src="<?= base_url() ?>/assets/plugins/datatables-select/js/select.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>/assets/plugins/datatables-select/css/select.bootstrap4.min.css"></script> -->

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-primary navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- SEARCH FORM -->

      <!-- Right navbar links -->
      <input type="text" class="form-control input-sm col-md-3" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <span class="dropdown-item dropdown-header bg-light"><?= $session->get('emaila'); ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header"><?= $session->get('emaila'); ?></span>
            <div class="dropdown-divider"></div>
            <a href="<?= site_url('admin/logout') ?>" class="dropdown-item">
              <i class="fas fa-logout mr-2"></i> Logout
              <span class="float-right text-muted text-sm"></span>
            </a>
          </div>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
            <i class="fas fa-th-large"></i>
          </a>
        </li> -->
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= site_url('admin/'); ?>" class="brand-link">
        <img src="" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin FasilkomFest2020</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="<?= site_url('admin') ?>" class="nav-link <?php if (site_url() == 'admin') { ?>active<?php  } ?> ">
                <i class="nav-icon fas fa-flag-checkered"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <?php if (session()->get('level_a') != 2) : ?>
              <li class="nav-item">
                <a href="<?= site_url('admin/users') ?>" class="nav-link <?php if (site_url() == 'admin') { ?>active<?php  } ?> ">
                  <i class="nav-icon fas fa-user"></i>
                  <p>
                    Users
                  </p>
                </a>
              </li>
            <?php endif; ?>
            <li class="nav-item">
              <a href="<?= site_url('admin/team') ?>" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Team
                  <span class="right badge badge-danger">
                    <?php
                    // if (isset($peserta)) {
                    //   echo $peserta;
                    // };  
                    ?></span>
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="<?= site_url('admin/sendemail') ?>" class="nav-link">
                <i class="nav-icon fas fa-mail-bulk"></i>
                <p>
                  Send Email
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-laptop-code"></i>
                <p>
                  Competition
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/tables/simple.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>CSO</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/tables/data.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>FSC</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/tables/jsgrid.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>#</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"><?= $letak ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Home</a></li>
                <li class="breadcrumb-item active"><?= $letak ?></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <div class="flash-data" data-flashdata="<?= session()->getFlashdata('success') ?>"></div>
      <div class="flash-data-e" data-flashdata="<?= session()->getFlashdata('error') ?>"></div>
      <?php if (session()->has('success')) : ?>

      <?php endif; ?>


      <?= $this->renderSection('isi'); ?>


    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">

      <strong> Desain <a href="http://adminlte.io">Admin LTE</a>.</strong>
      <a href="">Website Dibuat Oleh Diyon </a>
      Page rendered in {elapsed_time} seconds


    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>


  <!-- <script src="<?= base_url() ?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script> -->
  <script src="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.1/dist/sweetalert2.all.min.js" integrity="sha256-I//nGqEYcRlQfWdLiDc5tcWUU3GzGfJpZWs2qsfj3Dk=" crossorigin="anonymous"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>

  <script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- <script src="<?= base_url() ?>/assets/plugins/jquery-knob/jquery.knob.min.js"></script> -->
  <!-- <script src="<?= base_url() ?>/assets/plugins/daterangepicker/daterangepicker.js"></script> -->
  <!-- Summernote -->
  <script src="<?= base_url() ?>/assets/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <!-- <script src="<?= base_url() ?>/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>/assets/dist/js/adminlte.js"></script>
  <!-- <script src="<?= base_url() ?>/assets/dist/js/pages/dashboard.js"></script> -->

  <!-- AdminLTE for demo purposes -->
  <!-- <script src="<?= base_url() ?>/assets/dist/js/demo.js"></script> -->
  <script type="text/javascript">
    const flashData = $('.flash-data').data('flashdata');
    if (flashData) {
      $(function() {
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timerProgressBar: true,
          timer: 15000
        });
        Toast.fire({
          icon: 'success',
          title: flashData,
          type: 'success',
        });

      });
    }
  </script>
  <script type="text/javascript">
    const flashDatae = $('.flash-data-e').data('flashdata');
    if (flashDatae) {
      $(function() {
        const Toast = Swal.mixin({
          toast: true,
          position: 'center',
          showConfirmButton: true,
          timerProgressBar: true,
          // timer: 10000
        });
        Toast.fire({
          icon: 'error',
          title: flashDatae,
          type: 'success',
        });

      });
    }
  </script>

  <script>
    $(function() {
      // Summernote
      $('.textarea').summernote()
    })
  </script>
</body>

</html>