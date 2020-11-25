<div class="modal" id="pesertadata" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Anggota</h5><br>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="datateam" class="w-100 table table-bordered table-striped">
                        <thead>
                            <tr class="text-sm">
                                <th>full name</th>
                                <th>Foto</th>
                                <th>Gender</th>
                                <th>Telepon</th>
                                <th>Line</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($anggota as $member) : ?>
                                <tr>
                                    <td><?= $member['full_name'] ?></td>
                                    <td><img src="<?= base_url() ?>/upload/img/photo/<?= $member['image_student_card'] ?>" class="img-size-64" alt=""></td>
                                    <td><?= $member['gender'] ?></td>
                                    <td><?= $member['handphone'] ?></td>
                                    <td><a href="http://line.me/ti/p/~<?= $member['line'] ?>"><?= $member['line'] ?></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>