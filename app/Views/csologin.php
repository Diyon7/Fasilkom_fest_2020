<div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color:rgba(0, 0, 0, 0.3); margin:0; padding:0">
    <div class="modal-dialog">
        <div class="modal-content" style="padding: 5px; margin:0; border-radius:5px">
            <div class="modal-header" style="background: rgb(2,0,36); background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(129,0,0,1) 51%, rgba(255,0,0,1) 100%); padding-top:0em" ;>
                <h5 class="modal-title" id="exampleModalLabel" style="color: white; font-family:Verdana, Geneva, Tahoma, sans-serif">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background-color: transparent; border-style: none; margin-top:0px; padding:25px; margin-left:0em; font-size: 25px; color:rgba(0, 0, 0, 0.3)">
                    X
                </button>
            </div>
            <div class="modal-body" style="border: 1px dotted black;">
                <?= form_open('cso/loginauth', ['class' => 'formuser']) ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address add</label>
                    <input type="text" class="form-control" name="email" id="email">
                    <small id="emailHelp" class="form-text text-muted erroremail"></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                    <small class="form-text text-muted errorpassword"></small>
                </div>
                <div class="form-group" style="margin-top: 25px; margin-bottom: 15px; text-decoration: underline"><a class="teal-text lpassword" href="#" onclick="forgotPassword()">Lupa password?</a></div>
                <div class="modal-footer" style="background-color: transparent; border-style:none;">
                    <button type="submit" class="btn btn-primary btnsimpan">Masuk</button>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.formuser').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                // data: {
                //     csrf_test_name: $('input[name=csrf_test_name]').val()
                // },
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Submit');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.email) {
                            $('#email').addClass('is-invalid');
                            $('.erroremail').html(response.error.email);
                        } else {
                            $('#email').removeClass('is-invalid')
                            $('.erroremail').html('');
                        }
                        if (response.error.password) {
                            $('#password').addClass('is-invalid');
                            $('.errorpassword').html(response.error.password);
                        } else {
                            $('#password').removeClass('is-invalid')
                            $('.errorpassword').html('');
                        }

                    } else {
                        $('#tambahdata').modal('hide');
                        window.location.href = "<?= site_url('admin/users') ?>";
                    }
                    $('input[name=csrf_test_name]').val(response.csrf_test_name);
                },
            })
        })
    })
</script>
<script>
    function forgotPassword() {
        swal.queue([{
            title: 'Masukkan email ketua tim yang sudah terdaftar',
            input: 'email',
            inputClass: 'browser-default',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            cancelButtonColor: '#d33',
            allowOutsideClick: false,
            showLoaderOnConfirm: true,
            preConfirm: (email) => {
                return APIManager.forgotPasswordTeam(email)
                    .then(function(response) {
                        var statusCode = response.status_code;
                        var message = response.message;
                        var data = response.data;
                        if (statusCode == 1) {
                            // Jika berhasil
                            swal.insertQueueStep({
                                type: 'success',
                                title: 'Berhasil!',
                                text: message,
                                allowOutsideClick: false,
                            });
                        } else {
                            // Jika tidak berhasil
                            swal.insertQueueStep({
                                type: 'error',
                                title: 'Gagal!',
                                text: message,
                                allowOutsideClick: false,
                            });
                        }
                    })
                    .catch(function(error) {
                        // Jika koneksi error
                        swal.insertQueueStep({
                            type: 'question',
                            title: 'Koneksi?',
                            text: 'Cek koneksi anda',
                            allowOutsideClick: false,
                        });
                    });
            }
        }]);
    }
</script>