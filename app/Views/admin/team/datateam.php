<div class="form-row center">
  <div class="col-xs-10">
    <div class="card">
      <div class="card-header text-center">
        Filter
      </div>
      <div class="card-body">
        <div class="form-row">
          <div class="col-xs-5">
            <label>Register : </label><br>
            <label>Pembayaran : </label>
          </div>
          <div class="col-xs-5">
            <select name="" class="form-control input-sm" id="regisf">
              <option value="">[ Pilih ]</option>
              <option value="1">Belum Valid</option>
              <option value="2">Menunggu Konfirmasi</option>
              <option value="3">Valid</option>
            </select>
            <select name="" class="form-control input-sm" id="bayarf">
              <option value="">[ Pilih ]</option>
              <option value="1">Belum Bayar</option>
              <option value="2">Menunggu Konfirmasi</option>
              <option value="3">wes bayar</option>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="col-xm-10">
    <div class="card">
      <div class="card-header text-center">
        Update
      </div>
      <?= form_open('admin/team/delete', ['class' => 'formhapusbanyak']); ?>
      <?= csrf_field(); ?>
      <form id="updateregis">
        <div class="card-body">
          <div class="col-xs-5">
            <label>Registrasi</label>
            <div class="form-row">
              <select name="" class="form-control input-sm" id="uregis">
                <option value="">[ Pilih ]</option>
                <option value="1">Belum Valid</option>
                <option value="2">Menunggu Konfirmasi</option>
                <option value="3">Valid</option>
              </select>
              <button id="btnuregis">Update Dicentang</button>
              <a href=""><input type="text" name="regis" value="Update Dicentang"></a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div> -->

  <div class="table-responsive">
    <table id="datateam" class="w-100 table table-bordered table-striped">
      <thead>
        <tr class="text-sm">
          <th>ID</th>
          <th>Email</th>
          <th>Asal Sekolah</th>
          <th>Nama Tim</th>
          <th>Member</th>
          <th>Bukti Pembayaran</th>
          <th>Registrasi</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
      <tfoot>
        <tr>
          <th>ID</th>
          <th>Email</th>
          <th>Asal Sekolah</th>
          <th>Nama Tim</th>
          <th>Member</th>
          <th>Bukti Pembayaran</th>
          <th>Registrasi</th>
          <th>Aksi</th>
        </tr>
      </tfoot>
    </table>
  </div>

  <?= form_close(); ?>
  <div class="vieweditdata" style="display: none;"></div>


  <script type="text/javascript">
    var table = $('#datateam').DataTable({
      language: {
        searchPlaceholder: "sekolah, team, email"
      },
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        "url": "<?= site_url('ajax/listdata') ?>",
        "type": "POST",
        "data": {
          csrf_test_name: $('input[name=csrf_test_name]').val()
        },
        "data": function(data) {
          data.csrf_test_name = $('input[name=csrf_test_name]').val();
          data.regisf = $('#regisf').val();
          data.bayarf = $('#bayarf').val();
        },
        "dataSrc": function(response) {
          $('input[name=csrf_test_name]').val(response.csrf_test_name);
          return response.data;
        }
      },
      "columnDefs": [{
        "targets": 0,
        "orderable": false,
      }],
    })

    function listdatateam() {}

    function peserta(id) {
      $.ajax({
        type: "post",
        url: "<?= site_url('ajax/pesertadata') ?>",
        data: {
          noidp: id,
          csrf_test_name: $('input[name=csrf_test_name]').val()
        },
        dataType: "json",
        success: function(response) {
          if (response.sukses) {
            $('.vieweditdata').html(response.sukses).show();
            $('#pesertadata').modal('show');
          }
          $('input[name=csrf_test_name]').val(response.csrf_test_name);
        },
        error: function(xhr, ajaxOption, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
    }

    function bayar(id) {
      $.ajax({
        type: "post",
        url: "<?= site_url('ajax/bayar') ?>",
        data: {
          noidp: id,
          csrf_test_name: $('input[name=csrf_test_name]').val()
        },
        dataType: "json",
        success: function(response) {
          if (response.sukses) {
            $('.vieweditdata').html(response.sukses).show();
            $('#bayar').modal('show');
          }
          $('input[name=csrf_test_name]').val(response.csrf_test_name);
        },
        error: function(xhr, ajaxOption, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
    }

    function edit(id) {
      $.ajax({
        type: "post",
        url: "<?= site_url('ajax/formupdatedata') ?>",
        data: {
          noid: id,
          csrf_test_name: $('input[name=csrf_test_name]').val()
        },
        dataType: "json",
        success: function(response) {
          if (response.sukses) {
            $('.vieweditdata').html(response.sukses).show();
            $('#editdata').modal('show');
          }
          $('input[name=csrf_test_name]').val(response.csrf_test_name);
        },
        error: function(xhr, ajaxOption, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
    }


    $('.regis').change(function() {
      table.draw();
    });
    $('#regisf').change(function() {
      table.draw();
    })
    $('#bayarf').change(function() {
      table.draw();
    })
  </script>