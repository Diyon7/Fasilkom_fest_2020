<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('isi') ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pilihan</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item active">
                                <a href="#" class="nav-link" onclick="manual()">
                                    <i class="fas fa-inbox"></i> Manual
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" onclick="register()">
                                    <i class="far fa-sticky-note"></i> Registrasi Valid
                                    <span class="badge bg-primary float-right"><?= $tvrpeserta ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" onclick="bayar()">
                                    <i class="far fa-file-alt"></i> Pembayaran Selesai
                                    <span class="badge bg-primary float-right"><?= $tvbpeserta ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Riwayat</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="konfirm_rregister()">
                                    <i class="far fa-circle text-danger"></i> Konfirmasi Registrasi
                                    <span class="badge bg-primary float-right"><?= $tvrmailers ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="confirm_pem()">
                                    <i class="far fa-circle text-danger"></i> Konfirmasi Pembayaran
                                    <span class="badge bg-primary float-right"><?= $tvbmailers ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 dataemail">
                <div class="card card-primary card-outline" id="register">
                    <div class="card-header">
                        <h3 class="card-title">Kirim</h3>
                    </div>
                    <div class="card-body">
                        <?= form_open('admin/pesanemail/kirim', ['class' => 'formhapusbanyak'], ['method' => 'POST']); ?>
                        <?= csrf_field(); ?>
                        <div class="vieweditdata"></div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
            <!-- /.card-footer -->
        </div>
    </div>
    </div>
    </div>
</section>
<script type="text/javascript">
    function manual() {
        $.ajax({
            type: "post",
            url: "<?= site_url('ajax/email/manual') ?>",
            data: {
                csrf_test_name: $('input[name=csrf_test_name]').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.vieweditdata').html(response.sukses).show();
                    $('#manual').show();
                }
                $('input[name=csrf_test_name]').val(response.csrf_test_name);
            },
            error: function(xhr, ajaxOption, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    };
    manual();

    function konfirm_register() {
        $.ajax({
            type: "post",
            url: "<?= site_url('ajax/email/manual') ?>",
            data: {
                csrf_test_name: $('input[name=csrf_test_name]').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.vieweditdata').html(response.sukses).show();
                    $('#manual').show();
                }
                $('input[name=csrf_test_name]').val(response.csrf_test_name);
            },
            error: function(xhr, ajaxOption, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    };

    function register() {
        $.ajax({
            type: "post",
            url: "<?= site_url('ajax/email/register') ?>",
            data: {
                csrf_test_name: $('input[name=csrf_test_name]').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.vieweditdata').html(response.sukses).show();
                    $('#register').show();
                }
                $('input[name=csrf_test_name]').val(response.csrf_test_name);
            },
            error: function(xhr, ajaxOption, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function bayar() {
        $.ajax({
            type: "post",
            url: "<?= site_url('ajax/email/bayar') ?>",
            data: {
                csrf_test_name: $('input[name=csrf_test_name]').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.vieweditdata').html(response.sukses).show();
                    $('#bayar').show();
                }
                $('input[name=csrf_test_name]').val(response.csrf_test_name);
            },
            error: function(xhr, ajaxOption, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    };
</script>
<?= $this->endSection() ?>