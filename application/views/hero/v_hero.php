<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data <?= $title ?></h3>

            <div class="card-tools">
                <a href="<?= base_url('hero/add') ?>" type="button" class="btn btn-success btn-sm"><i class="fas fa-plus"></i>
                    ADD</a>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            if ($this->session->flashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Succes! ';
                echo $this->session->flashdata('pesan');
                echo '</h5></div>';
            }
            ?>
            <table class="table table-bordered" id="example1">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>Persetujuan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($hero as $key => $v) { ?>
                        <tr class="text-center">
                            <form action="<?php echo base_url() . 'hero/update_status/' ?>" method="POST">
                                <td><?= $no++ ?></td>
                                <td><img src="<?= base_url('assets/slider/' . $v->file_foto) ?>" width="100px"></td>
                                <td><?php
                                    if ($v->status_foto == 'disetujui') {
                                        echo '<span class="badge bg-success">Disetujui</span>';
                                    } else {
                                        echo '<span class="badge bg-warning">Belum Disetujui</span>';
                                    }
                                    ?></td>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="hidden" name="id_hero" class="form-control" value="<?php echo $v->id_hero ?>">
                                        <select class="form-control" name="status_foto">
                                            <option value="">--- Persetujuan ---</option>
                                            <option value="belum_disetujui">Belum Disetujui</option>
                                            <option value="disetujui">Disetujui</option>
                                        </select>
                                    </div>
                                    <?php
                                    if ($this->session->userdata('level_user') == 1) {
                                        echo anchor('hero/update_status/' . $v->id_hero, '<button type="submit" class="btn btn-success">Perbarui</button>');
                                    }
                                    ?>
                                </td>
                            </form>
                            <td><button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $v->id_hero ?>"><i class="fas fa-trash"></i></button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<?php

foreach ($hero as $key => $v) { ?>
    <div class="modal fade" id="delete<?= $v->id_hero ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Data akan terhapus, pastikan data sudah benar.</h6>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('hero/delete/' . $v->id_hero) ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>

<script>
    function previewGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#gambar_load').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#preview_gambar").change(function() {
        previewGambar(this);
    })
</script>