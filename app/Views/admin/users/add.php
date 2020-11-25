<div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5><br>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('admin/users/add', ['class' => 'formuser']) ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="text" class="form-control" name="email" id="email">
                    <small id="emailHelp" class="form-text text-muted erroremail"></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                    <small class="form-text text-muted errorpassword"></small>
                </div>
                <button type="submit" class="btn btn-primary btnsimpan">Submit</button>
                <?= form_close(); ?>
            </div>
            <div class="modal-footer">
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