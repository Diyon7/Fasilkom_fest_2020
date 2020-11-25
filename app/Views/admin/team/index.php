<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('isi') ?>

<div class="align-item-center">
    <div class="row">
        <div class="col">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tabel Soal</h4>
                    </div>
                    <div class="card-body viewdata">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<script type="text/javascript">
    function datateam() {
        $.ajax({
            url: "<?= site_url('ajax/get_team') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOption, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    $(document).ready(function() {
        datateam();
    });
</script>

<?= $this->endSection() ?>